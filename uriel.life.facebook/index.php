<?php
/*
Description:    Main facebook index page

****************History************************************
Date:         	1.11.2011
Author:       	Allen Halsted
Mod:          	Creation
***********************************************************
*/
include ($_SERVER['DOCUMENT_ROOT'] . '/uriel.life.common/lib/config/tbs.inc.php');
include_once ($_SERVER['DOCUMENT_ROOT'] . '/gabriel.common/misc/system_start_session.inline.php');
include_once ($_SERVER['DOCUMENT_ROOT'] . '/uriel.life.facebook/lib/config/config.inc.php');
include_once ($_SERVER['DOCUMENT_ROOT'] . '/gabriel.life/lib/system/global_object_control.php');

//default settings
$myserver = $_SERVER['SERVER_NAME'];

$ip=$_SERVER['REMOTE_ADDR'];
if($ip != '76.164.117.224') header( 'Location: http://www.appdata.com/' ) ;


//load the facebook API
include($_SERVER['DOCUMENT_ROOT'] . '/uriel.life.facebook/lib/system/facebook_init.inline.php');


if (isset($_GET['Bj9U1oC']))
{
	//Connect Friends
	if (isset($_GET['connect_friends']))
	{
		//process new friends and show the results
		include($_SERVER['DOCUMENT_ROOT'] . '/uriel.life.facebook/lib/system/facebook_friends.inline.php');
	}
	//Get Gifts
	if (isset($_GET['get_gift']))
	{
		//process new gifts and show the results
		include($_SERVER['DOCUMENT_ROOT'] . '/uriel.life.facebook/lib/system/facebook_gifts.inline.php');
	}

	//Send Requested Items


	//let the javascript know to show the request accepted page
	$acceptedRequest = true;
}
//who all the gift was sent too
if(isset($_REQUEST['ids']))
{

	//save $_REQUEST['ids'] to database table
	$idList = '';
	$result = $_REQUEST['ids'];
	foreach ($result as $id)
	{
    	if($idList=='')
    		$idList = $id;
    	else
			$idList = $idList.','.$id;
	}
	unset($id);
	unset($result);
	if(isset($_SESSION['uriel_userid']))
	{
		$user_id = $_SESSION['uriel_userid'];
		$dal_Player = objController::getPlayerDAL();
		$dal_Player->Request_Sent($user_id,$idList);
	}
}


//show the game
include($_SERVER['DOCUMENT_ROOT'] . '/uriel.life.facebook/lib/system/facebook_mylife.inline.php');


$tpl = new clsTinyButStrong;
//Load and display the template
$tpl->LoadTemplate($tmplatefile);
$tpl->Show();

unset($tpl);

//Final Memory cleanup
objController::cleanUp();
?>
