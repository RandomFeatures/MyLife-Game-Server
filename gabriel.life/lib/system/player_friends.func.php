<?php
/*
Description:   functions for dealing with friends list

****************History************************************
Date:         	02.18.2011
Author:       	Allen Halsted
Mod:          	Creation
***********************************************************
*/

include_once ($_SERVER['DOCUMENT_ROOT'].'/gabriel.life/lib/system/global_object_control.php');

function ConnectFriends($friendID,$MyfacebookID)
{
	$dal_Player = objController::getPlayerDAL();

	$dal_Player->Friends_Join($friendID,$MyfacebookID);

}






?>