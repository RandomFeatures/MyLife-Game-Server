<?php
/*
Description:    verify the username and password 
                
****************History************************************
Date:         	1.11.2011
Author:       	Allen Halsted
Mod:          	Creation
***********************************************************
*/

include $_SERVER['DOCUMENT_ROOT'] . '/gabriel.common/misc/system_destroy_session.inline.php';
include ($_SERVER['DOCUMENT_ROOT'].'/uriel.life.web/lib/config/config.inc.php');
include $_SERVER['DOCUMENT_ROOT'] . '/gabriel.myaccount/lib/system/gameplay.class.php';


if (isset($_POST['username']) && isset($_POST['password']))
{
	
	//Log in and start the game form an http post
	$objGamePlay=new clsGamePlay(GAME_ID, SOURCE_TYPE);
	$success = $objGamePlay->Login($_POST['username'], $_POST['password']);
	unset($objGamePlay);
	if ($success)
	{
		header ("Location:http://".$_SERVER['SERVER_NAME']."/uriel.life.web/index.php?mylife");
    	die(); //
	}else
		print "Login Failed";
	
}elseif (isset($_GET['username']) && isset($_GET['password']))
{
	//Allow a URL request with user name and pss so set the session
	$objGamePlay=new clsGamePlay(GAME_ID, SOURCE_TYPE);
	$success = $objGamePlay->Login($_GET['username'], $_GET['password']);
	unset($objGamePlay);
	if ($success)
	{
    	print "Login Success";	 	
	}else
		print "Login Failed";	
}


?>
