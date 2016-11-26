<?php
/*
Description:   Functions for dealing with pending gifts

****************History************************************
Date:         	2.18.2011
Author:       	Allen Halsted
Mod:          	Creation
***********************************************************
*/

include_once ($_SERVER['DOCUMENT_ROOT'].'/gabriel.common/misc/common.func.php');
include_once ($_SERVER['DOCUMENT_ROOT'].'/gabriel.life/lib/system/global_object_control.php');

function AddPendingGift($userID,$ItemID,$Source,$ItemType)
{
		$dal_Player = objController::getPlayerDAL();
		$IDKey = generatePassword(7,2);

		$dal_Player->Pending_Upd($userID,$ItemType,$ItemID,$Source,$IDKey,0);

		return $IDKey;
}

function CollectMyReward($userID, $pendingKey)
{
	$dal_Player = objController::getPlayerDAL();

	$rtn = false;

	$result = $dal_Player->Pending_Sel($userID,$pendingKey);
	if(isset($result))
	{
		ProcessPending($userID, $result[0]->ItemType, $result[0]->ItemID);
		unset($result);
		//record that player has gift so he cant get it again
		$dal_Player->Pending_Complete($userID,$pendingKey);
		$rtn = true;
	}

	return $rtn;
}

function CollectGift($userID, $pendingKey)
{
	$dal_Player = objController::getPlayerDAL();

	$rtn = false;

	$result = $dal_Player->Pending_Collect($userID,$pendingKey);
	if(isset($result))
	{
		ProcessPending($userID, $result[0]->ItemType, $result[0]->ItemID);
		unset($result);
		$rtn = true;
	}

	return $rtn;
}


function ProcessPending($user_id, $ItemType, $ItemID)
{
	$dal_Player = objController::getPlayerDAL();
	$mem_Static = objController::getStaticMEM();

	//see what type of item it is and give to player
	switch($ItemType)
	{
		case 0: //Decore
			$item = $mem_Static->GetBuilding($ItemID);
			//TODO add to church
			//TODO return church id
			break;
		case 1: //Building

			$item = $mem_Static->GetBuilding($ItemID);
			//TODO add to church
			//TODO return church id
			break;
		case 2: //Collection
			//Get the item details
			$item = $mem_Static->GetCollectionItem($ItemID);

			//record item
			$dal_Player->printLastError();
			$dal_Player->Collections_Upd($user_id,$item->CollectionID,$ItemID,1);
			$dal_Player->printLastError();
			unset($item);
			break;
	}
}

function &LookupItem($ItemType, $ItemID)
{

	$mem_Static = objController::getStaticMEM();
	$item = null;
	//see what type of item it is and give to player
	switch($ItemType)
	{
		case 0: //Decore
		case 1: //Building
			$item = $mem_Static->GetBuilding($ItemID);
			break;
		case 2: //Collection
			//Get the item details
			$item = $mem_Static->GetCollectionItem($ItemID);
			break;
	}

	return $item;
}


?>
