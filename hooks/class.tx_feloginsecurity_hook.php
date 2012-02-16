<?php
/***************************************************************
*  Copyright notice
*
*  (c) 2012 Loek Hilgersom <loek@netcoop.nl>
*  All rights reserved
*
*  This script is part of the TYPO3 project. The TYPO3 project is
*  free software; you can redistribute it and/or modify
*  it under the terms of the GNU General Public License as published by
*  the Free Software Foundation; either version 2 of the License, or
*  (at your option) any later version.
*
*  The GNU General Public License can be found at
*  http://www.gnu.org/copyleft/gpl.html.
*
*  This script is distributed in the hope that it will be useful,
*  but WITHOUT ANY WARRANTY; without even the implied warranty of
*  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
*  GNU General Public License for more details.
*
*  This copyright notice MUST APPEAR in all copies of the script!
***************************************************************/
/**
 * [CLASS/FUNCTION INDEX of SCRIPT]
 *
 *
 *
 *   47: class tx_feloginsecurity_hook extends tslib_pibase
 *   59:     function postLoginDelay(&$pObj)
 *
 * TOTAL FUNCTIONS: 1
 * (This index is automatically created/updated by the extension "extdeveval")
 *
 */

require_once(PATH_t3lib.'class.t3lib_svbase.php');


/**
 * Hooks "Frontend Login Security" for the "felogin_security" extension.
 *
 * @author	Loek Hilgersom <loek@netcoop.nl>
 * @package	TYPO3
 * @subpackage	tx_feloginsecurity
 */
class tx_feloginsecurity_hook extends tslib_pibase {
	var $prefixId = 'tx_feloginsecurity_hook';		// Same as class name
	var $scriptRelPath = 'hooks/class.tx_feloginsecurity_hook.php';	// Path to this script relative to the extension dir.
	var $extKey = 'felogin_security';	// The extension key.

	/**
	 * Add a delay after failed FE login attempts
	 * Clean up logged attempts on successful login
	 *
	 * @param object $pObj
	 * @return void
	 */
	function postLoginDelay(&$pObj) {

		$userAuthObj = $pObj['pObj'];
		$emConf = unserialize($GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf']['felogin_security']);
		#if (TYPO3_DLOG) t3lib_div::devLog('postLoginDelay', $this->extKey, 0, array(print_r($pObj, TRUE)));

		if ($userAuthObj->loginType == 'FE') {

			if ($userAuthObj->loginFailure == 1) {

				// Failed login attempt
				sleep($emConf['minLoginInterval']);

			} elseif ($userAuthObj->loginSessionStarted == 1) {

				// Successful login, delete failed login attempts for this user from log
				$table = 'tx_feloginsecurity';
				$GLOBALS['TYPO3_DB']->exec_DELETEquery(
						$table,
						'user_id=' . $userAuthObj->user['uid'] . ' AND logintype=' . $GLOBALS['TYPO3_DB']->fullQuoteStr($userAuthObj->loginType, $table)
					);

			}

		}

	}

}

if (defined('TYPO3_MODE') && isset($GLOBALS['TYPO3_CONF_VARS'][TYPO3_MODE]['XCLASS']['ext/felogin_security/hooks/class.tx_feloginsecurity_hook.php'])) {
	include_once($GLOBALS['TYPO3_CONF_VARS'][TYPO3_MODE]['XCLASS']['ext/felogin_security/hooks/class.tx_feloginsecurity_hook.php']);
}

?>