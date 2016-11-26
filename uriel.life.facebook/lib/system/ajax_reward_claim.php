<?php
/*
Description:    claim chosen reward and add it the player inventory

****************History************************************
Date:         	2.14.2011
Author:       	Allen Halsted
Mod:          	Creation
***********************************************************
*/
include_once ($_SERVER['DOCUMENT_ROOT'] . '/uriel.life.facebook/lib/config/config.inc.php');
include_once ($_SERVER['DOCUMENT_ROOT'].'/gabriel.life/lib/system/player_stats.class.php');
include_once ($_SERVER['DOCUMENT_ROOT'] . '/gabriel.common/misc/system_start_session.inline.php');

if(isset($_SESSION['uriel_userid']))
{

	$stats = new clsPlayerStats();

	if($stats->getSetup()==2)//setup complete and I am choosing a reward
	{
		$stats->addSetup();//reward chosed done...

		$user_id = $_SESSION['uriel_userid'];

		if(isset($_GET['reward']))
		{
			$reward = $_GET['reward'];
			$ItemType = substr($reward,0,1);
			$ItemID = substr($reward,1);
			//add to inventory
			$dal_Player = objController::getPlayerDAL();
			$dal_Player->Inventory_Upd($user_id,$ItemID,$ItemType,1);
		}

	}
	unset($stats);

}


?>