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
 * Hint: use extdeveval to insert/update function index above.
 */

require_once(PATH_t3lib.'class.t3lib_svbase.php');


/**
 * Service "Frontend Login Security" for the "felogin_security" extension.
 *
 * @author	Loek Hilgersom <loek@netcoop.nl>
 * @package	TYPO3
 * @subpackage	tx_feloginsecurity
 */
class tx_feloginsecurity_authuser extends t3lib_svbase {
	var $prefixId = 'tx_feloginsecurity_authuser';		// Same as class name
	var $scriptRelPath = 'service/class.tx_feloginsecurity_authuser.php';	// Path to this script relative to the extension dir.
	var $extKey = 'felogin_security';	// The extension key.

	private $loginType;

	/**
	 * Initialize the service object, pick some values from the authInfo array
	 *
	 * @param string authentication service subtype (e.g. "authUserFE")
	 * @return void
	 */
	function initAuth($subType, $loginData, $authInfo, $pObj)	{
	#	$available = parent::init();

		#t3lib_div::devLog('auth initAuth', $this->extKey, 0, array('subType' => $subType, 'loginData' => $loginData, 'authInfo' => $authInfo, 'pObj' => print_r($pObj, TRUE)));

		// Get relevant data
		$this->loginType = $authInfo['loginType'];	// FE or BE
		$this->httpHost = $authInfo['HTTP_HOST'];
		$this->remoteAddr = $authInfo['REMOTE_ADDR'];
		$this->remoteHost = $authInfo['REMOTE_HOST'];

		$this->emConf = unserialize($GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf']['felogin_security']);
		#t3lib_div::devLog('auth initAuth', $this->extKey, 0, $this->emConf);
	}

	/**
	 * Checks if this user has already tried to login in the last few seconds, if so, block login
	 *
	 * @param array User record for the user that tries to login
	 * @return int possible values: 200: authenticated, 100: not-authenticated, continue, 0: authentication failed (blocked)
	 */
	function authUser($user)	{

		// 100 means not yet authenticated, continue with next auth service
		$authResult = 100;

		$table = 'tx_feloginsecurity';
		$where = 'user_id=' . $user['uid'] . ' AND logintype LIKE ' . $GLOBALS['TYPO3_DB']->fullQuoteStr($this->loginType, $table);

		#t3lib_div::devLog('authUser where', $this->extKey, 0, array($this->emConf['minLoginInterval']));

		$result = $GLOBALS['TYPO3_DB']->exec_SELECTgetSingleRow('lastloginattempt', $table, $where);
		if ($result) {
			$nowInterval = time() - $this->emConf['minLoginInterval'];
			if ($result['lastloginattempt'] >= $nowInterval) {
				// 0 means authentication failed (blocked login attempt because too many attempts in short time frame)
				$authResult = 0;
				t3lib_div::devLog('authUser blocked', $this->extKey, 0, array($result['lastloginattempt'] => $nowInterval));
			}
			// Update tstamp for this login attempt
			$GLOBALS['TYPO3_DB']->exec_UPDATEquery($table, $where, array('lastloginattempt' => time()));
			#t3lib_div::devLog('authUser update', $this->extKey, 0);
		} else {
			// Insert record with tstamp of this login attempt
			$GLOBALS['TYPO3_DB']->exec_INSERTquery(
					$table,
					array(
						'user_id' => $user['uid'],
						'logintype' => $this->loginType,
						'lastloginattempt' => time()
					)
				);
			#t3lib_div::devLog('authUser insert', $this->extKey, 0);
		}

		// Delete old records
		$cleanUpAfterSeconds = $this->emConf['cleanUpAfterSeconds'];
		if ($cleanUpAfterSeconds != 0) {
			$GLOBALS['TYPO3_DB']->exec_DELETEquery($table, 'lastloginattempt<' . intval(time()-$cleanUpAfterSeconds));
			#t3lib_div::devLog('authUser delete', $this->extKey, 0, array('lastloginattempt' => intval(time()-$cleanUpAfterSeconds)));
		}

		return $authResult;
	}

}



if (defined('TYPO3_MODE') && $TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/felogin_security/service/class.tx_feloginsecurity_authuser.php'])	{
	include_once($TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/felogin_security/service/class.tx_feloginsecurity_authuser.php']);
}

?>