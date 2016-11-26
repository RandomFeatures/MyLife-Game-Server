<?php
/*
Description:    Product Purchase System
 
 ****************History************************************
 Date:         	1.12.2011
 Author:       	Allen Halsted
 Mod:          	Creation
 ***********************************************************
 */
include ($_SERVER['DOCUMENT_ROOT'].'/gabriel.myaccount/lib/config/myaccount.config.inc.php');
include ($_SERVER['DOCUMENT_ROOT'].'/gabriel.myaccount/lib/dal/dao_myaccount.class.php');
include_once ($_SERVER['DOCUMENT_ROOT'].'/gabriel.common/misc/system_start_session.inline.php');

class clsSystem {
	
	private $game_id;
	private $source_type;
	private $user_id = '';	
	private $objDAL;	

	function __construct($GameID, $SourceType) {
		$this->game_id = $GameID;
		$this->source_type = $SourceType;
		$this->user_id = (isset($_SESSION['uriel_userid'])) ? $_SESSION['uriel_userid'] : '';
		$this->objDAL = new daoMyAccount(DB_HOST, DB_USER, DB_PASS, DB_ACCOUNT);
	}

	public function &LogEvent($EventCode, $CallerType, $Comments) {
		
		$this->objDAL->Event_Insert($EventCode, $this->user_id, $this->game_id, $CallerType, $Comments);
		
	}
	
	public function &LogErrors($Process,$ErrorMsg,$Xml) {

		$this->objDAL->Error_Log($this->user_id, $this->game_id, $Process, $ErrorMsg, $Xml);
    }
	
}
?>

