<?php
/*
Description:   update the players wishlist
				send in item id to update and 0 to delete

****************History************************************
Date:         	01.26.2011
Author:       	Allen Halsted
Mod:          	Creation
***********************************************************
*/

/* Key
 * Item1: 7B1k98s
 * Item2: i3so7NC
 * Item3: BC2s8J0
 * Item4: v4624N1
 * Item5: kUJ9Sj9
 */


include_once ($_SERVER['DOCUMENT_ROOT'].'/gabriel.common/misc/system_start_session.inline.php');
include_once ($_SERVER['DOCUMENT_ROOT'].'/gabriel.life/lib/system/global_object_control.php');


if(isset($_SESSION['uriel_userid']))
{

	$user_id = $_SESSION['uriel_userid'];
	$dal_Player = objController::getPlayerDAL();

	//add items to wishlist
	//remove items from wish list

	$dal_Player->Wishlist_Upd($user_id,$_GET['7B1k98s'],$_GET['i3so7NC'],$_GET['BC2s8J0'],$_GET['v4624N1'],$_GET['kUJ9Sj9']);


}

?>