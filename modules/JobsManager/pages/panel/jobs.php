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


$smarty->assign(array(
	'SUBMIT' => $language->get('general', 'submit'),
	'YES' => $language->get('general', 'yes'),
	'NO' => $language->get('general', 'no'),
	'ARE_YOU_SURE' => $language->get('general', 'are_you_sure'),
	'CONFIRM_DELETE' => $language->get('general', 'confirm_delete'),
	'TITLE' => $JobsManagerLanguage->get('general', 'title'),
	'ADD_NEW_JOBS' => $JobsManagerLanguage->get('general', 'add_job'),
	'EDIT_URL' => URL::build('/panel/jobs/edit', 'action=edit&id='),
	'ADD_URL' => URL::build('/panel/jobs/edit', 'action=new'),
	'JOBS_LIST' => CronTab::getJobs()
));

if (isset($_POST['delete_value'])) {

	if (Input::exists()) {
		$errors = array();
		if (Token::check(Input::get('token'))) {

			$job_arr_id = (int) Input::get('delete_value');

			if (is_int($job_arr_id)) {
				CronTab::removeJobId($job_arr_id);
				Session::flash('staff', $JobsManagerLanguage->get('general', 'delete_successfully'));
				Redirect::to(URL::build('/panel/jobs'));
			} else {
				$errors[] = $JobsManagerLanguage->get('general', 'delete_errors');
			}
		} else {
			$errors[] = $language->get('general', 'invalid_token');
		}
	}
}

$template_file = 'JobsManager/jobs.tpl';

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
