<?php
/*
Description:    Get the registration data from the website
				and submit it to the server
               
****************History************************************
Date:         	1.14.2011
Author:       	Allen Halsted
Mod:          	Creation
***********************************************************
*/

include $_SERVER['DOCUMENT_ROOT'] . '/gabriel.common/misc/system_destroy_session.inline.php';
include ($_SERVER['DOCUMENT_ROOT'].'/uriel.life.web/lib/config/config.inc.php');
include $_SERVER['DOCUMENT_ROOT'] . '/gabriel.myaccount/lib/system/gameplay.class.php';


if (isset($_POST['username']) && isset($_POST['password']) && isset($_POST[captcha]))
{
	$success = FALSE;
	
	if($_POST[captcha] == $_SESSION[captcha])
	{
		$objGamePlay=new clsGamePlay(GAME_ID, SOURCE_TYPE);
		$username = (isset($_POST['username'])) ? $_POST['username'] : ''; 
		$password = (isset($_POST['password'])) ? $_POST['password'] : ''; 
		$firstname = (isset($_POST['firstname'])) ? $_POST['firstname'] : ''; 
		$lastname = (isset($_POST['lastname'])) ? $_POST['lastname'] : ''; 
		$email = (isset($_POST['email'])) ? $_POST['email'] : ''; 
	
		$_SESSION['username'] = $username;
		$_SESSION['password'] = $password;
		
		$success = $objGamePlay->Register($username, $password, $firstname, $lastname, $email, '');
		unset($_SESSION[captcha]); 
		unset($objGamePlay);
		
	}
	
	if ($success)
	{
		header ("Location:http://".$_SERVER['SERVER_NAME']."/uriel.life.web/index.php?mylife");
		die();
	}else
		print "Registeration Failed - You failed the Captcha test";
	
	
}else
	print "Registeration Failed - You have to provide a username, password and pass the Captcha test";
	
		
		
		
		
?>
