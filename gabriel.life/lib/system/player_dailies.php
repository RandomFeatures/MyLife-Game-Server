<?php
/*
Description:   Dailies

****************History************************************
Date:         	01.21.2011
Author:       	Allen Halsted
Mod:          	Creation
***********************************************************
*/

/* Key
 * DailyType:11Q43fv
 * 	start:Da42hu1
 * 	finish:9X75p7M
 * buildingID:eP215VC
 * dailyID:53C3dA7
 * churchID:rK98751
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

	$building_id = $_GET['eP215VC'];
	$daily_id = $_GET['53C3dA7'];
	$church_id = $_GET['rK98751'];

	switch($_GET['11Q43fv'])
	{
		case 'Da42hu1'://Start Daily
			$daily = $mem_Static->GetDaily($dailyid);
			$dal_Player->Building_Recharge_Upd($user_id,$church_id,$building_id,$daily_id,$daily->RechargeTime,0);
			unset($daily);
			break;
		case '9X75p7M'://complete daily
			//Get the current status
			$result = $dal_Player->Building_Recharge_Sel($user_id,$church_id);
			$recharge_id = $result[0]->id;

			//minutes since started
			$seconds = time() - strtotime( $result[0]->LastUsed );
			$minutes = $seconds / 60;


			//make sure time has elapsed
			if($minutes>=$result[0]->RechargeTime)//more than 1 hour
			{
				//remove the record
				$dal_Player->Building_Recharge_Del($recharge_id);

				//get the daily master
				$daily = $mem_Static->GetDaily($daily_id);

				//update players reward in DB
				$stats->addReward($daily->Xp,$daily->Coins,$daily->Bookmarks,$daily->JobApproval,0,0,0,0);

				if($stats.checkLevelUp())
				{
					$level = 1;
				}else
					$level = 0;
				//get the reward XML
				$xml = buildRewardXML($stats->getStatsXML(),'',$daily->Coins,$daily->Bookmarks,$daily->JobApproval,$daily->Xp,$level,0,0);
				unset($daily);

			}else //not ready yet xml
				$xml = $XML_BEGIN.str_replace('##headerid##','Dailies',$XML_Header).$stats->getStatsXML().$XML_END;

			//cleanup
			unset($result);

			//return results
			print $xml;
			break;
	}



	//minutes since started
	//$seconds = time() - strtotime( $row['rdate'] );
	//$minutes = $seconds / 60;

	unset($stats);
}

?>