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

$INFO_MODULE = array(
	'name' => 'JobsManager',
	'author' => '<a href="https://tensa.co.ua" target="_blank" rel="nofollow noopener">xGIGABAITx</a>',
	'module_ver' => '1.0.5',
	'nml_ver' => '2.0.0-pr10',
);

$JobsManagerLanguage = new Language(ROOT_PATH . '/modules/' . $INFO_MODULE['name'] . '/language', LANGUAGE);

$GLOBALS['JobsManagerLanguage'] = $JobsManagerLanguage;

require_once(ROOT_PATH . '/modules/' . $INFO_MODULE['name'] . '/module.php');

$module = new JobsManager($language, $pages, $INFO_MODULE);
