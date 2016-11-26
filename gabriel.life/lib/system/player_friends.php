<?php
/*
Description:   Update and track players friends list

****************History************************************
Date:         	01.26.2011
Author:       	Allen Halsted
Mod:          	Creation
***********************************************************
*/

/* Key
 * Type: mE63kR7
 * 	lookup: bKkw1WX
 * 	add: pQ78P3T
 * 	mission: ef8T6Ed
 * 	update: 88q0BPI
 * Xref: t7KL116 //this is me
 * FriendID: D8L6tmO //id of the friend
 */



include_once ($_SERVER['DOCUMENT_ROOT'] . '/gabriel.life/lib/system/xml_player.class.php');
include_once ($_SERVER['DOCUMENT_ROOT'] . '/gabriel.common/misc/system_start_session.inline.php');
include_once ($_SERVER['DOCUMENT_ROOT'].'/gabriel.life/lib/system/global_object_control.php');

if(isset($_SESSION['uriel_userid']))
{//normal usage

	$user_id = $_SESSION['uriel_userid'];
	//add to the friends list
	//update friends list


	switch($_GET['mE63kR7'])
	{
		case 'bKkw1WX': //Lookup friend
			$objPlayer = new clsPlayerXML();
			$xml = $objPlayer->GetPlayerFriendXML($_GET['D8L6tmO']);

			print($xml);
			//clean up
			unset($objPlayer);
			break;
		case 'pQ78P3T': //add new friend

			$objDAL = objController::getPlayerDAL();

			if (isset($_GET['t7KL116']))
				$objDAL->Friends_Join($_GET['G87wQLf'],$_GET['t7KL116']);
			elseif (isset($facebookid))
				$objDAL->Friends_Join($_GET['G87wQLf'],$facebookid);

			unset($_SESSION['pending_friend_'.GAME_ID]);
			break;
		case 'ef8T6Ed': //activate mission
			$objDAL->Friends_Used($user_id,$_GET['D8L6tmO']);
			break;
		case '88q0BPI': //update friend
			//get the update xml list
			$objPlayer = new clsPlayerXML();
			$xml = $objPlayer->GetPlayerFriendsXML();

			print($xml);
			//clean up
			unset($objPlayer);
			break;
	}


}



?>