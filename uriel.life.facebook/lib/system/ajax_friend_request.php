<?php
/*
Description:    show friends request form

****************History************************************
Date:         	1.17.2011
Author:       	Allen Halsted
Mod:          	Creation
***********************************************************
*/
include_once ($_SERVER['DOCUMENT_ROOT'] . '/uriel.life.facebook/lib/config/config.inc.php');
include_once ($_SERVER['DOCUMENT_ROOT'].'/gabriel.common/misc/system_start_session.inline.php');

//this list does not need to show people who are already your friends
if(isset($_SESSION['uriel_userid']))
{
	$excludeids = '';
	$user_id = $_SESSION['uriel_userid'];
	$facebookID = $_SESSION['xref'];
	$dal_Player = objController::getPlayerDAL();
	$result = $dal_Player->Friends_Lst($user_id);
	if($result)
	{
		reset($result);
		foreach ($result as $row)
		{
			if($excludeids=='')
				$excludeids = $row->XRef;
			else
				$excludeids = $excludeids.','.$row->XRef;
		}
	}
}

$image = 'http://'.$_SERVER['SERVER_NAME'].'/uriel.life.facebook/public/images/ticket.png';

$callbackURL = htmlentities('<fb:req-choice url="'.CANVAS_BASE_URL.'?connect_friends&Bj9U1oC&mE63kR7=pQ78P3T&D8L6tmO='.$facebookID.'" label="Accept and Play" />');

$redirectURL = 'http://'.$_SERVER['SERVER_NAME'].'//uriel.life.facebook/';

$tmplatename = 'fbml_friend_request.tpl.php';
$tmplatefile = $_SERVER['DOCUMENT_ROOT'] . '/uriel.life.facebook/lib/templates/' . $tmplatename;



?>
