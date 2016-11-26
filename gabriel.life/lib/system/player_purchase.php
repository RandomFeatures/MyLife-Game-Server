<?php
/*
Description:   Store Purchases

****************History************************************
Date:         	01.21.2011
Author:       	Allen Halsted
Mod:          	Creation
***********************************************************
*/


/* Key
 *
 */


include ($_SERVER['DOCUMENT_ROOT'].'/gabriel.life/lib/system/player_stats.class.php');
include ($_SERVER['DOCUMENT_ROOT'].'/gabriel.life/lib/system/xml_templates.func.php');
include_once ($_SERVER['DOCUMENT_ROOT'].'/gabriel.common/misc/system_start_session.inline.php');
include_once ($_SERVER['DOCUMENT_ROOT'].'/gabriel.life/lib/system/global_object_control.php');

if(isset($_SESSION['uriel_userid']))
{

	$user_id = $_SESSION['uriel_userid'];
	$dal_Player = objController::getPlayerDAL();
	$mem_Static = objController::getStaticMEM();
	$stats = new clsPlayerStats();


	unset($stats);

}

?>