<?php
/*
Description:    authorize facebook..should only happen if the player has never played?!

****************History************************************
Date:         	2.11.2011
Author:       	Allen Halsted
Mod:          	Creation
***********************************************************
*/

include_once ($_SERVER['DOCUMENT_ROOT'] . '/uriel.life.facebook/lib/config/config.inc.php');
include_once ($_SERVER['DOCUMENT_ROOT'] . '/gabriel.common/misc/system_start_session.inline.php');
include ($_SERVER['DOCUMENT_ROOT'] . '/uriel.life.facebook/lib/system/facebook_login.func.php');
include_once ($_SERVER['DOCUMENT_ROOT'].'/gabriel.life/lib/system/global_object_control.php');


if(isset($_REQUEST["code"]))
{
	$code = $_REQUEST["code"];
	$my_url = CANVAS_BASE_URL.'authorize.php';

	$token_url = "https://graph.facebook.com/oauth/access_token?client_id="
        . APP_ID . "&redirect_uri=" . urlencode($my_url) . "&type=web_server&client_secret="
        . APP_SECRET . "&code=" . $code;

    $access_token = file_get_contents($token_url);

    $graph_url = "https://graph.facebook.com/me?" . $access_token;

    $fbme = json_decode(file_get_contents($graph_url),true);

    if(isset($_SESSION['pending_friend_'.GAME_ID])) $pending_Friend = $_SESSION['pending_friend_'.GAME_ID];
    if(isset($_SESSION['pending_gift_'.GAME_ID])) $pending_Gift = $_SESSION['pending_gift_'.GAME_ID];

    if (facebook_register($fbme))
    {
	    $facebookID = $fbme['id'];
	    $_SESSION['xref'] = $facebookID;
	    $_SESSION['access_token'] = $access_token;


	    //look for pending crap
	    if(isset($pending_Friend))
	    {
	    	include ($_SERVER['DOCUMENT_ROOT'].'/gabriel.life/lib/system/player_friends.func.php');

	    	$friendID = $pending_Friend;
	    	ConnectFriends($friendID,$facebookID);

	    	//unset($_SESSION['pending_friend_'.GAME_ID]);

	    }
	    //look for pending gifts
		if (isset($pending_Gift))
		{
			include ($_SERVER['DOCUMENT_ROOT'].'/gabriel.life/lib/system/player_pending.func.php');

			$user_id = $_SESSION['uriel_userid'];
			$IDKey = $pending_Gift;
			//get the reward that could be for many people
			CollectGift($user_id,$IDKey);

			//unset($_SESSION['pending_gift_'.GAME_ID]);
		}
    }
    unset($fbme);

    //redirect to main page
    header("Location: http://".$_SERVER['SERVER_NAME']."/uriel.life.facebook/");


}

//Final Memory cleanup
objController::cleanUp();
?>