<?php
/*
 *	Made by Samerton
 *  https://github.com/NamelessMC/Nameless/tree/v2/
 *  NamelessMC version 2.0.0-pr7
 *
 *  License: MIT
 *
 *  JobsManager By xGIGABAITx
 */

class JobsManager extends Module
{

	private $_language, $JobsManagerLanguage;

	public function __construct($language, $pages, $INFO_MODULE)
	{
		$this->_language = $language;

		$this->JobsManagerLanguage = $GLOBALS['JobsManagerLanguage'];

		$name = $INFO_MODULE['name'];
		$author = $INFO_MODULE['author'];
		$module_version = $INFO_MODULE['module_ver'];
		$nameless_version = $INFO_MODULE['nml_ver'];
		parent::__construct($this, $name, $author, $module_version, $nameless_version);

		$pages->add('JobsManager', '/panel/jobs', 'pages/panel/jobs.php');
		$pages->add('JobsManager', '/panel/jobs/edit', 'pages/panel/edit.php');
	}

	public function onInstall()
	{
	}

	public function onUninstall()
	{
	}

	public function onEnable()
	{

		$queries = new Queries();

		try {

			$group = $queries->getWhere('groups', array('id', '=', 2));
			$group = $group[0];

			$group_permissions = json_decode($group->permissions, TRUE);
			$group_permissions['admincp.jjoobs'] = 1;

			$group_permissions = json_encode($group_permissions);
			$queries->update('groups', 2, array('permissions' => $group_permissions));
		} catch (Exception $e) {
			// Ошибка
		}
	}

	public function onDisable()
	{
	}

	public function onPageLoad($user, $pages, $cache, $smarty, $navs, $widgets, $template)
	{

		PermissionHandler::registerPermissions('JobsManager', array(
			'admincp.jjoobs' => $this->JobsManagerLanguage->get('general', 'group_permision')
		));


		$icon = '<i class="nav-icon fas fa-toolbox"></i>';
		$order = 26;

		if (defined('BACK_END')) {

			$title =  $this->JobsManagerLanguage->get('general', 'title');


			if ($user->hasPermission('admincp.jjoobs')) {

				$navs[2]->add('jobs_divider', mb_strtoupper($title, 'UTF-8'), 'divider', 'top', null, $order, '');

				$navs[2]->add('jobs_items', $title, URL::build('/panel/jobs'), 'top', null, $order + 0.1, $icon);
			}
		}
	}
}
