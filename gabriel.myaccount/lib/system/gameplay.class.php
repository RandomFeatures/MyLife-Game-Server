<?php
/*
 Description:    System Gameplay
 
 ****************History************************************
 Date:         	1.13.2011
 Author:       	Allen Halsted
 Mod:          	Creation
 ***********************************************************
 */
include ($_SERVER['DOCUMENT_ROOT'] . '/gabriel.myaccount/lib/config/myaccount.config.inc.php');
include ($_SERVER['DOCUMENT_ROOT'] . '/gabriel.myaccount/lib/dal/dao_myaccount.class.php');
include_once ($_SERVER['DOCUMENT_ROOT'] . '/gabriel.common/misc/system_start_session.inline.php');

class clsGamePlay {
    
	
	private $game_id;
	private $source_type;	
	private $objDAL;
	
	
	function __construct($GameID, $SourceType) {
		$this->game_id = $GameID;
		$this->source_type = $SourceType;
		$this->objDAL = new daoMyAccount(DB_ACC_HOST, DB_ACC_USER, DB_ACC_PASS, DB_ACCOUNT);
	}
	
	function __destruct() 
 	{
    	unset($this->objDAL);
   	}
		
	
	
	public function Login($Login, $Password) {
		
		$rnt = false;
		
		$result = $this->objDAL->Login_User($Login, $Password, $this->game_id, $this->source_type);
		
		if(isset($result))
		{
			$rnt = $this->SessionLogin($result[0]->indx);
		}
			
		return $rnt;
    }
	
	public function xRefLogin($xref) {
        
		$rtn = false;
		$result = $this->objDAL->Login_XRef($xref, $this->source_type, $this->game_id);
		
		if(isset($result))
		{
			$rtn = $this->SessionLogin($result[0]->indx);
		}
		
		return $rtn;
    }
	
	public function Register($username, $password, $firstname, $lastname, $email, $xref) {
        
		$rtn = false;
		$result = $this->objDAL->Register_User($xref, $firstname, $lastname, $username, $password, $email, $this->source_type, $this->game_id);
		
		if(isset($result))
		{
			$rtn = $this->SessionLogin($result[0]->indx);
		}
		
		return $rtn;
		
	}
	
    
    private function SessionLogin($UserID)
    {
    	$rtn = FALSE;
		//Track Session Data
		if($UserID>0)
		{
			$_SESSION['uriel_userid'] = $UserID;
			$rtn = TRUE;
		}
        
		return $rtn;
    }
	
}
?>
