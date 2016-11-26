<?php
/*
Description:   functions for dealing with quests

****************History************************************
Date:         	02.18.2011
Author:       	Allen Halsted
Mod:          	Creation
***********************************************************
*/

include_once ($_SERVER['DOCUMENT_ROOT'].'/gabriel.life/lib/system/global_object_control.php');


function GetPlayerQuest($quiestID, $stepID, $stepNumber)
{

}


function CheckStorePurchase($ItemID)
{
	$mem_Static = objController::getStaticMEM();
	$trigger = $mem_Static->GetQuestTrigger(1,$ItemID);

	if ($trigger != null)


}

function CheckCollectItem($ItemID)
{
	$mem_Static = objController::getStaticMEM();
	$trigger = $mem_Static->GetQuestTrigger(2,$ItemID);


}

function CheckCompleteCollection($CollectionID)
{
	$mem_Static = objController::getStaticMEM();
	$trigger = $mem_Static->GetQuestTrigger(3,$CollectionID);


}

function CheckAddFriend()
{
	$mem_Static = objController::getStaticMEM();
	$trigger = $mem_Static->GetQuestTrigger(4,0);


}

function CheckStartDaily($DailyID)
{
	$mem_Static = objController::getStaticMEM();
	$trigger = $mem_Static->GetQuestTrigger(5,$DailyID);


}

function CheckStartMission($MissionID)
{
	$mem_Static = objController::getStaticMEM();
	$trigger = $mem_Static->GetQuestTrigger(6,$MissionID);


}

function CheckCompletQuest($QuestID)
{
	$mem_Static = objController::getStaticMEM();
	$trigger = $mem_Static->GetQuestTrigger(7,$QuestID);


}

function CheckSendGift($GiftID)
{
	$mem_Static = objController::getStaticMEM();
	$trigger = $mem_Static->GetQuestTrigger(8,$GiftID);


}

function CheckGetGift($GiftID)
{
	$mem_Static = objController::getStaticMEM();
	$trigger = $mem_Static->GetQuestTrigger(9,$GiftID);


}


function CheckWishList()
{
	$mem_Static = objController::getStaticMEM();
	$trigger = $mem_Static->GetQuestTrigger(10,0);


}

function CheckRequestPrayer()
{
	$mem_Static = objController::getStaticMEM();
	$trigger = $mem_Static->GetQuestTrigger(11,0);


}

function CheckWallPost()
{
	$mem_Static = objController::getStaticMEM();
	$trigger = $mem_Static->GetQuestTrigger(12,0);


}



?>