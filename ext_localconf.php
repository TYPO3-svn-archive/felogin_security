<?php
if (!defined('TYPO3_MODE')) {
	die ('Access denied.');
}

t3lib_extMgm::addService($_EXTKEY, 'auth',  'tx_feloginsecurity_authuser',
	array(
		'title' => 'Frontend Login Security',
		'description' => 'Brute force blocker',

		'subtype' => 'authUserFE',

		'available' => TRUE,
		'priority' => 100,
		'quality' => 100,

		'os' => '',
		'exec' => '',

		'classFile' => t3lib_extMgm::extPath($_EXTKEY).'service/class.tx_feloginsecurity_authuser.php',
		'className' => 'tx_feloginsecurity_authuser',
	)
);

// Register hook for adding a delay after failed login
$TYPO3_CONF_VARS['SC_OPTIONS']['t3lib/class.t3lib_userauth.php']['postUserLookUp'][$_EXTKEY] = 'EXT:' . $_EXTKEY . '/hooks/class.tx_feloginsecurity_hook.php:tx_feloginsecurity_hook->postLoginDelay';

?>