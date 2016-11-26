<?php
/*
Description:    init teh facebook object
                
****************History************************************
Date:         	1.11.2011
Author:       	Allen Halsted
Mod:          	Creation
***********************************************************
*/
include_once ($_SERVER['DOCUMENT_ROOT'] . '/uriel.life.facebook/lib/config/config.inc.php');
include_once ($_SERVER['DOCUMENT_ROOT'] . '/gabriel.common/misc/system_start_session.inline.php');
include ($_SERVER['DOCUMENT_ROOT'] . '/gabriel.common/libs/facebook/facebook.class.php');
include ($_SERVER['DOCUMENT_ROOT'] . '/uriel.life.facebook/lib/system/facebook_login.func.php');

$authorized = false;
$fbme = null;

//try to log in and get settings
$facebook = new Facebook(array(
                'appId'  => APP_ID,
                'secret' => APP_SECRET,
				'cookie' => true,));
$session = $facebook->getSession();

  
if ($session) {  
    try {
	$facebookID = $facebook->getUser();
	
	$authorized = true;
	$encodesession = json_encode($session);
	$accesstoken = $session['access_token'];

	//log me into the system
	if(!facebook_login($facebookID))
	{//if login fails try to register
		facebook_register($facebook->api('/me'));
	}
	
	
	
  } catch (FacebookApiException $e) {
    error_log($e);
  }
}else
{
	$facebookID =  (isset($_SESSION['xref'])) ? $_SESSION['xref'] : '';
    $accesstoken = (isset($_SESSION['access_token'])) ? $_SESSION['access_token'] : '';
}

unset($facebook);	
unset($session);	



?>
