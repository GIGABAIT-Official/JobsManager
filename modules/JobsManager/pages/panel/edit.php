<?php
/*
 *  Made by Samerton
 *  https://github.com/NamelessMC/Nameless/tree/v2/
 *  NamelessMC version 2.0.0-pr7
 *
 *  License: MIT
 *
 *  JobsManager By xGIGABAITx
 */

$JobsManagerLanguage = $GLOBALS['JobsManagerLanguage'];
$page_title = $JobsManagerLanguage->get('general', 'title');

if ($user->isLoggedIn()) {
	if (!$user->canViewStaffCP()) {

		Redirect::to(URL::build('/'));
		die();
	}
	if (!$user->isAdmLoggedIn()) {

		Redirect::to(URL::build('/panel/auth'));
		die();
	} else {
		if (!$user->hasPermission('admincp.jjoobs')) {
			require_once(ROOT_PATH . '/403.php');
			die();
		}
	}
} else {
	// Not logged in
	Redirect::to(URL::build('/login'));
	die();
}

define('PAGE', 'panel');
define('PARENT_PAGE', 'jobs_items');
define('PANEL_PAGE', 'jobs_items');

require_once(ROOT_PATH . '/core/templates/backend_init.php');
require_once(ROOT_PATH . '/modules/JobsManager/Class/CronTab.php');

// var_dump(CronTab::getJobElementsId(11));


$smarty->assign(array(
	'SUBMIT' => $language->get('general', 'submit'),
	'CANCEL_URL' => URL::build('/panel/jobs'),
	'CANCEL' => $JobsManagerLanguage->get('general', 'cancel'),
	'TITLE' => $JobsManagerLanguage->get('general', 'title')
));

// Cron Generator
$smarty->assign(array(
	'COMMAND' => $JobsManagerLanguage->get('general', 'command'),
	'MINUTE' => $JobsManagerLanguage->get('general', 'minute'),
	'HOUR' => $JobsManagerLanguage->get('general', 'hour'),
	'DAY' => $JobsManagerLanguage->get('general', 'day'),
	'WEEK' => $JobsManagerLanguage->get('general', 'week'),
	'MONTH' => $JobsManagerLanguage->get('general', 'month'),
	'EXECUTE' => $JobsManagerLanguage->get('general', 'execute'),
	'EVERY_MINUTE' => $JobsManagerLanguage->get('general', 'every_minute'),
	'EVERY_2_MINUTES' => $JobsManagerLanguage->get('general', 'every_2_minutes'),
	'EACH_HOUR' => $JobsManagerLanguage->get('general', 'each_hour'),
	'EVERY_TWO_HOURS' => $JobsManagerLanguage->get('general', 'every_two_hours'),
	'EVERYDAY' => $JobsManagerLanguage->get('general', 'everyday'),
	'EVERY_ODD_DAY' => $JobsManagerLanguage->get('general', 'every_odd_day'),
	'EVERY_EVEN_DAY' => $JobsManagerLanguage->get('general', 'every_even_day'),
	'WORKING_DAY' => $JobsManagerLanguage->get('general', 'working_day'),
	'WEEKENDS' => $JobsManagerLanguage->get('general', 'weekends'),
	'MONDAY' => $JobsManagerLanguage->get('general', 'monday'),
	'TUESDAY' => $JobsManagerLanguage->get('general', 'tuesday'),
	'WEDNESDAY' => $JobsManagerLanguage->get('general', 'wednesday'),
	'THURSDAY' => $JobsManagerLanguage->get('general', 'thursday'),
	'FRIDAY' => $JobsManagerLanguage->get('general', 'friday'),
	'SATURDAY' => $JobsManagerLanguage->get('general', 'saturday'),
	'SUNDAY' => $JobsManagerLanguage->get('general', 'sunday'),
	'EVERY_MONTH' => $JobsManagerLanguage->get('general', 'every_month'),
	'EVERY_ODD_MONTH' => $JobsManagerLanguage->get('general', 'every_odd_month'),
	'EVERY_EVEN_MONTH' => $JobsManagerLanguage->get('general', 'every_even_month'),
	'JAN' => $JobsManagerLanguage->get('general', 'jan'),
	'FEB' => $JobsManagerLanguage->get('general', 'feb'),
	'MAR' => $JobsManagerLanguage->get('general', 'mar'),
	'APR' => $JobsManagerLanguage->get('general', 'apr'),
	'MAY' => $JobsManagerLanguage->get('general', 'may'),
	'JUNE' => $JobsManagerLanguage->get('general', 'june'),
	'JULE' => $JobsManagerLanguage->get('general', 'jul'),
	'AUG' => $JobsManagerLanguage->get('general', 'aug'),
	'SEP' => $JobsManagerLanguage->get('general', 'sep'),
	'OCT' => $JobsManagerLanguage->get('general', 'oct'),
	'NOV' => $JobsManagerLanguage->get('general', 'nov'),
	'DEC' => $JobsManagerLanguage->get('general', 'dec'),
	'EVERY' => $JobsManagerLanguage->get('general', 'every'),
	'GENERATE' => $JobsManagerLanguage->get('general', 'generate')

));

switch ($_GET['action']) {

	case 'edit':

		if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
			Redirect::to(URL::build('/panel/jobs'));
			die();
		}

		$job_arr_id = (int) $_GET['id'];
		$smarty->assign(array(
			'JOB' => CronTab::getJobElementsId($job_arr_id)
		));


		if (isset($_POST['command'])) {

			if (Input::exists()) {
				$errors = array();
				if (Token::check(Input::get('token'))) {

					if (is_int($job_arr_id)) {

						$job_str = CronTab::jobElementsArrayToString($_POST);
						if ($job_str != false) {

							CronTab::editJobId($job_arr_id, $job_str);
							Session::flash('staff', $JobsManagerLanguage->get('general', 'edited_successfully'));
							Redirect::to(URL::build('/panel/jobs'));
						} else {
							$errors[] = $JobsManagerLanguage->get('general', 'edit_errors');
						}
					} else {
						$errors[] = $JobsManagerLanguage->get('general', 'invalid_job_id');
					}
				} else {
					$errors[] = $language->get('general', 'invalid_token');
				}
			}
		}
		break;

	case 'new':

		$smarty->assign(array(
			'JOB' => array(
				'minute' => '*',
				'hour' => '*',
				'day' => '*',
				'month' => '*',
				'day_week' => '*'
			)
		));

		if (isset($_POST['command'])) {

			if (Input::exists()) {
				$errors = array();
				if (Token::check(Input::get('token'))) {

					$job_str = CronTab::jobElementsArrayToString($_POST);
					if ($job_str != false) {

						CronTab::addJob($job_str);
						Session::flash('staff', $JobsManagerLanguage->get('general', 'add_successfully'));
						Redirect::to(URL::build('/panel/jobs'));
					} else {
						$errors[] = $JobsManagerLanguage->get('general', 'add_errors');
					}
				} else {
					$errors[] = $language->get('general', 'invalid_token');
				}
			}
		}
		break;

	default:
		Redirect::to(URL::build('/panel/jobs'));
		die();
		break;
}








$template_file = 'JobsManager/edit.tpl';

$template->addJSFiles(array(
	(defined('CONFIG_PATH') ? CONFIG_PATH : '') . '/modules/JobsManager/Js/cron.js' => array()
));

// Load modules + template
Module::loadPage($user, $pages, $cache, $smarty, array($navigation, $cc_nav, $mod_nav), $widgets, $template);
$page_load = microtime(true) - $start;
define('PAGE_LOAD_TIME', str_replace('{x}', round($page_load, 3), $language->get('general', 'page_loaded_in')));
$template->onPageLoad();

if (Session::exists('staff'))
	$success = Session::flash('staff');

if (isset($success))
	$smarty->assign(array(
		'SUCCESS' => $success,
		'SUCCESS_TITLE' => $language->get('general', 'success')
	));

if (isset($errors) && count($errors))
	$smarty->assign(array(
		'ERRORS' => $errors,
		'ERRORS_TITLE' => $language->get('general', 'error')
	));

$smarty->assign(array(
	'TOKEN' => Token::get(),
));

require(ROOT_PATH . '/core/templates/panel_navbar.php');

$template->displayTemplate($template_file, $smarty);
