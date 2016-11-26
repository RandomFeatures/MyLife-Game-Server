<?php
/*
Description:   Missions

****************History************************************
Date:         	01.21.2011
Author:       	Allen Halsted
Mod:          	Creation
***********************************************************
*/

/*
 * MissionType:ODilFx9
 * 	MissionStart:YtMu31M
 * 	Convert:BKqr45g
 * MoodType:h7WYlvL
 * 	mood1:u2GJwc4
 * 	mood2:6P82u2J
 * 	mood3:Ef67mC4
 * friendid:UL05l6Z
 *
 */



include ($_SERVER['DOCUMENT_ROOT'].'/gabriel.life/lib/system/player_stats.class.php');
include ($_SERVER['DOCUMENT_ROOT'].'/gabriel.life/lib/system/xml_templates.func.php');
include ($_SERVER['DOCUMENT_ROOT'].'/gabriel.common/misc/common.func.php');
include_once ($_SERVER['DOCUMENT_ROOT'].'/gabriel.common/misc/system_start_session.inline.php');
include_once ($_SERVER['DOCUMENT_ROOT'].'/gabriel.life/lib/system/global_object_control.php');


if(isset($_SESSION['uriel_userid']))
{

	$user_id = $_SESSION['uriel_userid'];
	switch($_GET['ODilFx9'])//Mission Action
	{
		case 'YtMu31M':	//Start Mission
				$dal_Player = objController::getPlayerDAL();
				//lock this friend
				$dal_Player->Friends_Used($user_id,$_GET['UL05l6Z']);
			break;
		case 'BKqr45g'://convert sheeople
				$congregation = 0;
				$level = 0;
				$xp = 1;
				$energy = 0;
				$itemXML = '';

				$mem_Static = objController::getStaticMEM();
				$stats = new clsPlayerStats();

				switch($_GET['h7WYlvL'])//Sheeople type
				{
					case 'u2GJwc4'://Mood1	evil/lost	1XP, Donation
							$xp = 1;
							$energy = -1;
						break;
					case '6P82u2J'://Mood2	agnostic	3XP, Donation, Collectible
							$xp = 3;
							$energy = -2;
							$Item1Count = 0; $Item2Count = 0;$Item3Count = 0;$Item4Count = 0;$Item5Count = 0;

							$IDKey = generatePassword(7,2);

							//pick an item
							$itemlist = $mem_Static->GetRewardList($stats->getLevel());
							$item = $itemlist[rand(0, count($itemlist))];
							$itemXML = buildItemRewardXML($item,$IDKey);

							$dal_Player = objController::getPlayerDAL();
							//record item
							$dal_Player->Pending_Upd($user_id,3,$item->id,0,$IDKey,0);

							//clean up
							unset($itemlist);
							unset($item);
						break;
					case 'Ef67mC4'://Mood3	saved		5XP, Membership
							$congregation = rand(1, 5);
							$xp = 5;
							$energy = -3;
						break;
				}


				//update players reward in DB
				$stats->addReward($xp,0,0,0,$congregation,0,$energy,0);
				if($stats.checkLevelUp()) $level = 1;

				//get the reward XML
				$xml = buildRewardXML($stats->getStatsXML(),$itemXML,0,0,0,$xp,$level,$energy,$congregation);
				print $xml;

				unset($stats);
			break;
	}

}

?>