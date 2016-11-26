<?php
/*
Description:    functions to:
                	inital game setup
                	start a new session
                	destory an old session
                	init the game for play
****************History************************************
Date:         	01.16.2011
Author:       	Allen Halsted
Mod:          	Creation
***********************************************************
*/


include_once ($_SERVER['DOCUMENT_ROOT'].'/gabriel.life/lib/system/player_stats.class.php');
include_once ($_SERVER['DOCUMENT_ROOT'].'/gabriel.life/lib/system/global_object_control.php');

function game_init($facebookID){
	//get the ball rolling with player stats
	$stats = new clsPlayerStats();
	$stats->InitPlayerStats();

	$_SESSION['xref'] = $facebookID;

	unset($stats);
}

//setup a new game
function game_setup($firstname, $facebookID){

	$dal_Player = objController::getPlayerDAL();

	start_session();//just incase it is needed outside of register

	$user_id = $_SESSION['uriel_userid'];
	if(!isset($firstname))
		$firstname = (isset($_SESSION['playername'])) ? $_SESSION['playername'] : '';
	if(!isset($facebookID))
		$facebookID = (isset($_SESSION['xref'])) ? $_SESSION['xref'] : '';

	$dal_Player->Player_Start($user_id,$firstname,$facebookID);

	game_init($facebookID);
}


function start_session()
{
	if(!isset($_SESSION))
	{
		session_start(); // if no active session we start a new one
	}
}

function destroy_session()
{
	if(isset($_SESSION))
	{
		session_destroy();
		unset($_SESSION);
	}
}




?>