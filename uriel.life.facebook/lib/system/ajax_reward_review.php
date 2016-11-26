<?php
/*
Description:    log that the app is being reviewed
                
****************History************************************
Date:         	2.14.2011
Author:       	Allen Halsted
Mod:          	Creation
***********************************************************
*/
include_once ($_SERVER['DOCUMENT_ROOT'].'/gabriel.life/lib/system/player_stats.class.php');

if(isset($_SESSION['uriel_userid']))
{
	
	$stats = new clsPlayerStats();
	
	if($stats->getSetup()==0)//only gona do this if the player has just started
	{	
		$stats->addSetup();//update setup so I know I have reviewed
	}
	unset($stats);
	
}


?>