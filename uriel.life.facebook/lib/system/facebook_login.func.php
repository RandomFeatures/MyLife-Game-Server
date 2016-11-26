<?php
/*
Description:    functions to:
					Log the user in 
					Register new user
                	inital game setup
****************History************************************
Date:         	01.16.2011
Author:       	Allen Halsted
Mod:          	Creation
***********************************************************
*/

include ($_SERVER['DOCUMENT_ROOT'] . '/gabriel.common/misc/common.func.php');
include ($_SERVER['DOCUMENT_ROOT'] . '/gabriel.myaccount/lib/system/gameplay.class.php');
include_once ($_SERVER['DOCUMENT_ROOT'] . '/uriel.life.facebook/lib/config/config.inc.php');
include_once ($_SERVER['DOCUMENT_ROOT'].'/gabriel.life/lib/system/game_init.func.php');


//try to log the player in
function facebook_login($facebookID) {
	
	destroy_session();//get rid of any existing session
	
	start_session();//start a new session
	
	$objGamePlay=new clsGamePlay(GAME_ID, SOURCE_TYPE);
	$success = $objGamePlay->xRefLogin($facebookID);
	if($success)
	{
		game_init($facebookID);
	}
	unset($objGamePlay);	
	
	return $success;
}

//register a new player
function facebook_register($fbUser) {
	
	start_session();//start a new session
	$objGamePlay=new clsGamePlay(GAME_ID, SOURCE_TYPE);
	
	$facebookID = $fbUser['id'];
	$firstname = $fbUser['first_name'];
	$lastname = $fbUser['last_name'];
	//$email = $fbUser['email'];
	//if (!isset($email)) 
	$email = 'n/a';
	$loginname = $lastname.generatePassword(4,2);
	$password = generatePassword(8,2);

	$success = $objGamePlay->Register($loginname, $password, $firstname, $lastname, $email, $facebookID);
	
	if($success)
	{
		$_SESSION['playername'] = $firstname;
		if(isset($_SESSION['uriel_userid']))
			game_setup($firstname,$facebookID);
	}
	
	unset($objGamePlay);
		
	
	return $success;
}


	
?>
