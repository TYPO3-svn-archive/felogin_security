<?php

########################################################################
# Extension Manager/Repository config file for ext "felogin_security".
#
# Auto generated 12-02-2012 02:18
#
# Manual updates:
# Only the data in the array - everything else is removed by next
# writing. "version" and "dependencies" must not be touched!
########################################################################

$EM_CONF[$_EXTKEY] = array(
	'title' => 'FE login security',
	'description' => 'Block attempts for brute force password cracking on FE user accounts',
	'category' => 'services',
	'author' => 'Loek Hilgersom',
	'author_email' => 'lhilgersom@bkwi.nl',
	'shy' => '',
	'dependencies' => 'cms',
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
	'author_company' => '',
	'version' => '0.0.0',
	'constraints' => array(
		'depends' => array(
			'cms' => '',
		),
		'conflicts' => array(
		),
		'suggests' => array(
		),
	),
	'_md5_values_when_last_written' => 'a:10:{s:9:"ChangeLog";s:4:"b1f6";s:10:"README.txt";s:4:"ee2d";s:12:"ext_icon.gif";s:4:"1bdc";s:17:"ext_localconf.php";s:4:"4de7";s:14:"ext_tables.php";s:4:"d95a";s:14:"ext_tables.sql";s:4:"c3a4";s:16:"locallang_db.xml";s:4:"76e1";s:19:"doc/wizard_form.dat";s:4:"7cd0";s:20:"doc/wizard_form.html";s:4:"dcc1";s:36:"sv1/class.tx_feloginsecurity_sv1.php";s:4:"a889";}',
);

?>