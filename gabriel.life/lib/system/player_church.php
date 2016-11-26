<?php
/*
Description:   Buy, Sell, Move, Rotate Church property

****************History************************************
Date:         	01.21.2011
Author:       	Allen Halsted
Mod:          	Creation
***********************************************************
*/

/* Key
 * Type: eWQx2nv
 *  Move: u3v62H8
 *  Sell: X6Bs70t
 *  Buy: Q3uiNlg
 * ItemID: E21jLw8
 * ItemType: TvWRit5
 * facing: 3Oe7sc6
 * churchID: Mb2KN2c
 * X: 50g127R
 * Y: DmI4452
 * SubX: G0EczV2
 * SubY: y66LPUm
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

	//place buildings and decore
	//construction
	//move items
	//rotate
	switch($_GET['eWQx2nv'])
	{
		case 'u3v62H8': //Move
			$dal_Player->Church_Upd($_GET['Mb2KN2c'],$user_id,$_GET['TvWRit5'],$_GET['E21jLw8'],$_GET['50g127R'],$_GET['DmI4452'],$_GET['G0EczV2'],$_GET['y66LPUm'],$_GET['3Oe7sc6'],0);
			break;
		case 'X6Bs70t': //Sell
			switch($_GET['E21jLw8'])//ItemType
			{
				case 0: //decore
					$result = $mem_Static->GetDecore($_GET['E21jLw8']);

					break;
				case 1: //building
					$result = $mem_Static->GetBuilding($_GET['E21jLw8']);

					break;
			}
			if(isset($result))
			{
				$church = $dal_Player->Church_Sel($_GET['Mb2KN2c'],$user_id);
				if(isset($church) && $church[0]->Deleted == 0)
				{
					$stats->addCoins($result->SellValue);
					//remove the item
					$dal_Player->Church_Del($_GET['Mb2KN2c'],$user_id);
				}
				unset($result);
			}


			break;
		case 'Q3uiNlg': //Buy
			//look up the item to purchase
			$storeItem = $mem_Static->GetStoreItem($_GET['E21jLw8']);
			$level = 0;
			$canAfford = false;

			if(isset($storeItem))
			{//commit transation
				if ($storeItem->CostType == 0)
				{//coins
					$coins = -($storeItem->Cost);
					$bookmarks = 0;
					if($stats->getCoins() >= $coins) $canAfford = true;
				}else
				{//bookmarks
					$coins = 0;
					$bookmarks = -($storeItem->Cost);
					if($stats->getBookmarks() >= $bookmarks) $canAfford = true;
				}

				if ($canAfford)
				{
					//purchas item both cost and reward
					$stats->addReward($storeItem->XP,$coins,$bookmarks,$storeItem->JobApproval,0,0, 0, 0);
					if($stats.checkLevelUp()) $level = 1;

					//Add item to player
					$Church = $dal_Player->Church_Upd(0,$user_id,$storeItem->ItemType,$storeItem->ItemID,$_GET['50g127R'],$_GET['DmI4452'],$_GET['G0EczV2'],$_GET['y66LPUm'],$_GET['3Oe7sc6'],0);

					$NewChurchID = $Church[0]->indx;
					$TempChurchID = $_GET['Mb2KN2c'];
					$progressXML = '';
					if($storeItem->ItemType == 1)//building
					{
						//Get building requirements
						$require = $mem_Static->GetBuildingRequirmentsList($storeItem->ItemID);
						//make a building progress record
						$dal_Player->Building_Progress_Upd($user_id,$storeItem->ItemID,$NewChurchID,$require[0]->CollectionItemID,0,$require[0]->ItemCount,
 																				 $require[1]->CollectionItemID,0,$require[1]->ItemCount,$require[1]->BuyNow,
 																				 $require[2]->CollectionItemID,0,$require[2]->ItemCount,$require[2]->BuyNow,
 																				 $require[3]->CollectionItemID,0,$require[3]->ItemCount,$require[3]->BuyNow,
 																				 $require[4]->CollectionItemID,0,$require[4]->ItemCount,$require[4]->BuyNow,
 																				 $require[5]->CollectionItemID,0,$require[5]->ItemCount,$require[5]->BuyNow,0);
						//build buiLding progress xml
						$progressXML = '<progress building="'.$storeItem->ItemID.
												'" churchid="'.$NewChurchID.
												'" item1="'.$require[1]->CollectionItemID.
												'" item1Done="0'.
												'" item1Require="'.$require[1]->ItemCount.
												'" item1BuyNow="'.$require[1]->BuyNow.
												'" item2="'.$require[2]->CollectionItemID.
												'" item2Done="0'.
												'" item2Require="'.$require[2]->ItemCount.
												'" item2BuyNow="'.$require[2]->BuyNow.
												'" item3="'.$require[3]->CollectionItemID.
												'" item3Done="0'.
												'" item3Require="'.$require[3]->ItemCount.
												'" item3BuyNow="'.$require[3]->BuyNow.
												'" item4="'.$require[4]->CollectionItemID.
												'" item4Done="0'.
												'" item4Require="'.$require[4]->ItemCount.
												'" item4BuyNow="'.$require[4]->BuyNow.
												'" item5="'.$require[5]->CollectionItemID.
												'" item5Done="0'.
												'" item5Require="'.$require[5]->ItemCount.
												'" item5BuyNow="'.$require[5]->BuyNow.
												'" item6="'.$require[6]->CollectionItemID.
												'" item6Done="0'.
												'" item6Require="'.$require[6]->ItemCount.
												'" item6BuyNow="'.$require[6]->BuyNow.
												'" />';
						unset($require);
					}


					$xml = buildPurchaseXML($stats->getStatsXML(),$progressXML,$TempChurchID,$NewChurchID,$Coins,$Bookmarks,$JobApproval,$Experience,$Level);

					unset($Church);
				}else
				{//cant afford the purchase
					$xml = $XML_BEGIN.str_replace('##headerid##','Purchase',$XML_Header_Fail);
					$xml = $xml.$XML_END;
				}

				print $xml;
				//clean up
				unset($storeItem);
			}//cant find item to purchase
			break;
	}

	unset($stats);

}

?>