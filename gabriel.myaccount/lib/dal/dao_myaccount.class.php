<?php
/*
 Description:    Data Access Object for MyAccount
 
 ****************History************************************
 Date:         	1.12.2011
 Author:       	Allen Halsted
 Mod:          	Creation
 ***********************************************************
 */

include_once ($_SERVER['DOCUMENT_ROOT'].'/gabriel.common/libs/dal/dao_base.class.php');


 class daoMyAccount extends daoBase
 {
 	   
	   	
   	// Constructor
		function __construct($dbHost, $dbUser, $dbPass, $dbDatabase)
		{
			daoBase::__construct($dbHost, $dbUser, $dbPass, $dbDatabase);
		}
 		
		function __destruct() 
 		{
       		daoBase::__destruct();
   		}
		
		
		//Log user in from web
		public function Login_User($login, $pass, $gameid, $sourcetype)
		{
			$strStoredProc = 'dsp_login_user';
			$strParam = '("'.$login.'","'.$pass.'",'.$sourcetype.','.$gameid.')' ;
			$rtn = $this->Query($strStoredProc, $strParam);
			return $rtn;
		}
		
		//log user in from social network
		public function Login_XRef($xref, $sourcetype, $gameid)
		{
			$strStoredProc = 'dsp_login_xref';
			$strParam = '("'.$xref.'",'.$sourcetype.','.$gameid.')' ;

          	$rtn = $this->Query($strStoredProc, $strParam);
			return $rtn;
			
		}

		//Register user
		public function Register_User($xref, $first, $last, $login, $pass, $email, $sourcetype, $gameid)
		{
			$strStoredProc = 'dsp_register_user';
			$strParam = '("'.$xref.'","'.$first.'","'.$last.'","'.$login.'","'.$pass.'","'.$email.'",'.$sourcetype.','.$gameid.')';

          	$rtn = $this->Query($strStoredProc, $strParam);
			return $rtn;
		}


		//Log a user level event
		public function Event_Insert($eventcode, $userid, $gameid, $caller, $comments)
		{
			$strStoredProc = 'dsp_event_insert';
			$strParam = '('.$eventcode.','.$userid.','.$gameid.','.$caller.',"'.$comments.'")' ;

          	$this->Exec($strStoredProc, $strParam);
		}

		//log a system error
		public function Error_Log($userid, $gameid, $processname, $error, $xml)
		{
			$strStoredProc = 'dsp_error_log';
			$strParam = '('.$userid.','.$gameid.',"'.$processname.'","'.$error.'","'.$xml.'")' ;

          	$this->Exec($strStoredProc, $strParam);
			
		}

		//user start purchase procedures
		public function Product_Purchase($userid, $gameid, $productid, $purchasecode, $system)
		{
			$strStoredProc = 'dsp_product_purchase';
			$strParam = '('.$userid.','.$gameid.','.$productid.','.$purchasecode.','.$system.')' ;

          	$rtn = $this->Query($strStoredProc, $strParam);
			return $rtn;
		}

		//user completed purchase
		public function Product_Complete($userproductid, $userid, $gameid, $productid, $externalid, $externaldata)
		{
			$strStoredProc = 'dsp_product_complete';
			$strParam = '('.$userproductid.','.$userid.','.$gameid.','.$productid.',"'.$externalid.'","'.$externaldata.'")' ;

          	$rtn = $this->Query($strStoredProc, $strParam);
			return $rtn;
			
		}

		//verify purchase is pending
		public function Product_Verify($userproductid, $userid, $gameid, $productid)
		{
			$strStoredProc = 'dsp_product_verify';
			$strParam = '('.$userproductid.','.$userid.','.$gameid.','.$productid.')' ;

          	$rtn = $this->Query($strStoredProc, $strParam);
			return $rtn;

		}


		//user canceled purchase
		public function Product_Cancel($userproductid, $userid, $gameid, $productid, $externalid)
		{
			$strStoredProc = 'dsp_product_cancel';
			$strParam = '('.$userproductid.','.$userid.','.$gameid.','.$productid.',"'.$externalid.'")' ;

          	$this->Exec($strStoredProc, $strParam);
		}

		//apply the purchase to the users account
		public function Product_Apply($userid, $gameid, $productid)
		{
			$strStoredProc = 'dsp_product_apply';
			$strParam = '('.$userid.','.$gameid.','.$productid.')' ;

          	$this->Exec($strStoredProc, $strParam);
		}

		//look up a config value from the MyAccount Database
		public function Product_List($gameid)
		{
			$strStoredProc = 'dsp_product_list';
			$strParam = '('.$gameid.')' ;

          	$rtn = $this->Query($strStoredProc, $strParam);
			return $rtn;
		}
      

		//look up a config value from the MyAccount Database
		public function Config_GetValue($keyname, $gameid, $source)
		{
			$strStoredProc = 'dsp_config_getvalue';
			$strParam = '("'.$keyname.'",'.$gameid.','.$source.')' ;

          	$rtn = $this->Query($strStoredProc, $strParam);
			return $rtn;
		}
      
 }

?>
