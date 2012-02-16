<?php

########################################################################
# Extension Manager/Repository config file for ext "felogin_security".
#
# Auto generated 16-02-2012 00:19
#
# Manual updates:
# Only the data in the array - everything else is removed by next
# writing. "version" and "dependencies" must not be touched!
########################################################################

$EM_CONF[$_EXTKEY] = array(
	'title' => 'Improved FE login security',
	'description' => 'Block attempts for brute force password cracking on FE user accounts',
	'category' => 'services',
	'author' => 'Loek Hilgersom',
	'author_email' => 'loek@netcoop.nl',
	'shy' => '',
	'dependencies' => '',
	'conflicts' => '',
	'priority' => '',
	'module' => '',
	'state' => 'alpha',
	'internal' => '',
	'uploadfolder' => 0,
	'createDirs' => '',
	'modify_tables' => '',
	'clearCacheOnLoad' => 1,
	'lockType' => '',
	'author_company' => 'BKWI',
	'version' => '0.0.1',
	'constraints' => array(
		'depends' => array(
			'typo3' => '4.3.0-4.7.99',
		),
		'conflicts' => array(
		),
		'suggests' => array(
		),
	),
	'_md5_values_when_last_written' => 'a:13:{s:9:"ChangeLog";s:4:"b1f6";s:10:"README.txt";s:4:"ee2d";s:21:"ext_conf_template.txt";s:4:"b81e";s:12:"ext_icon.gif";s:4:"1bdc";s:17:"ext_localconf.php";s:4:"cf20";s:15:"ext_php_api.dat";s:4:"0f79";s:14:"ext_tables.php";s:4:"0643";s:14:"ext_tables.sql";s:4:"bdfe";s:16:"locallang_db.xml";s:4:"76e1";s:19:"doc/wizard_form.dat";s:4:"7cd0";s:20:"doc/wizard_form.html";s:4:"dcc1";s:39:"hooks/class.tx_feloginsecurity_hook.php";s:4:"d211";s:45:"service/class.tx_feloginsecurity_authuser.php";s:4:"54d2";}',
	'suggests' => array(
	),
);

?>