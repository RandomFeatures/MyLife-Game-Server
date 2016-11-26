<?php
/*
Description:   Update and track the progress the player has
				made on building buildings

****************History************************************
Date:         	01.26.2011
Author:       	Allen Halsted
Mod:          	Creation
***********************************************************
*/

/* Key
 * UpdateType: EEGw0J3
 * 	Complete: 8T6J50l
 * 	Buy Now: LuBM0Uw
 * ChurchID: x502o3Y
 * BuyNow: UU0n9e5
 *  Buy1: y7z8VC5
 *  Buy2: qPEW78D
 *  Buy3: bXL12Zf
 *  Buy4: C8CjmpT
 *  Buy5: S28f8pi
 *  Buy6: ngUL882
 */


include ($_SERVER['DOCUMENT_ROOT'].'/gabriel.life/lib/system/player_stats.class.php');
include ($_SERVER['DOCUMENT_ROOT'].'/gabriel.life/lib/system/xml_templates.func.php');
include_once ($_SERVER['DOCUMENT_ROOT'].'/gabriel.common/misc/system_start_session.inline.php');
include_once ($_SERVER['DOCUMENT_ROOT'].'/gabriel.life/lib/system/global_object_control.php');


if(isset($_SESSION['uriel_userid']))
{

	$user_id = $_SESSION['uriel_userid'];
	$dal_Player = objController::getPlayerDAL();
	$stats = new clsPlayerStats();

	//get the progress record
	$progress = $dal_Player->Building_Progress_Sel($user_id,$_GET['x502o3Y']);
	$Complete = 0;

	//get previous buys
	$Buy1 = $progress[0]->Item1Done;
	$Buy2 = $progress[0]->Item2Done;
	$Buy3 = $progress[0]->Item3Done;
	$Buy4 = $progress[0]->Item4Done;
	$Buy5 = $progress[0]->Item5Done;
	$Buy6 = $progress[0]->Item6Done;


	if($_GET['EEGw0J3']=='LuBM0Uw')
	{
		$canAfford = false;
		//make the purchase
		switch($_GET['UU0n9e5'])
		{
			case 'y7z8VC5'://Item1
				$cost = $progress[0]->Item1BuyNow;
				if($stats->getBookmarks() >= $cost)
				{
					$canAfford = true;
					$Buy1 = 1;
				}
				break;
			case 'qPEW78D'://Item2
				$cost = $progress[0]->Item2BuyNow;
				if($stats->getBookmarks() >= $cost)
				{
					$canAfford = true;
					$Buy2 = 1;
				}
				break;
			case 'bXL12Zf'://Item3
				$cost = $progress[0]->Item3BuyNow;
				if($stats->getBookmarks() >= $cost)
				{
					$canAfford = true;
					$Buy3 = 1;
				}
				break;
			case 'C8CjmpT'://Item4
				$cost = $progress[0]->Item4BuyNow;
				if($stats->getBookmarks() >= $cost)
				{
					$canAfford = true;
					$Buy4 = 1;
				}

				break;
			case 'S28f8pi'://Item5
				$cost = $progress[0]->Item5BuyNow;
				if($stats->getBookmarks() >= $cost)
				{
					$canAfford = true;
					$Buy5 = 1;
				}

				break;
			case 'ngUL882'://Item6
				$cost = $progress[0]->Item6BuyNow;
				if($stats->getBookmarks() >= $cost)
				{
					$canAfford = true;
					$Buy6 = 1;
				}
				break;
		}

		if ($canAfford)
		{
		 	//purchas item both cost and reward
			$stats->removeBookmarks($cost);
			$xml = $XML_BEGIN.str_replace('##headerid##','BuyNow',$XML_Header);
			$xml = $xml.'<reward experince="0'.
						       '" level="0'.
						       '" jobapproval="0'.
						       '" congergation="0'.
						       '" coins="0'.
						       '" bookmarks="'.-($cost).
						       '" energy="0'.
						       '" />';
			$xml = $xml.$stats->getStatsXML().$XML_END;
		}else
		{
			$xml = $XML_BEGIN.str_replace('##headerid##','BuyNow',$XML_Header_Fail);
			$xml = $xml.$XML_END;
		}

		print $xml;

	}


	//see if we are done
	if($Buy1+$Buy2+$Buy3+$Buy4+$Buy5+$Buy6 == 6)
	{
		$Complete = 1;
	}else
	{//see if this thing is complete now
		$item = $dal_Player->Collections_Item_Sel($user_id,$progress[0]->Item1);
		if(($Buy1 = 1) || ($item->ItemCount >= $progress[0]->Item1Require))
		{
			unset($item);
			$item = $dal_Player->Collections_Item_Sel($user_id,$progress[0]->Item2);
			if(($Buy2 = 1) || ($item->ItemCount >= $progress[0]->Item2Require))
			{
				unset($item);
				$item = $dal_Player->Collections_Item_Sel($user_id,$progress[0]->Item3);
				if(($Buy3 = 1) || ($item->ItemCount >= $progress[0]->Item3Require))
				{
					unset($item);
					$item = $dal_Player->Collections_Item_Sel($user_id,$progress[0]->Item4);
					if(($Buy4 = 1) || ($item->ItemCount >= $progress[0]->Item4Require))
					{
						unset($item);
						$item = $dal_Player->Collections_Item_Sel($user_id,$progress[0]->Item5);
						if(($Buy5 = 1) || ($item->ItemCount >= $progress[0]->Item5Require))
						{
							unset($item);
							$item = $dal_Player->Collections_Item_Sel($user_id,$progress[0]->Item6);
							if(($Buy6 = 1) || ($item->ItemCount >= $progress[0]->Item6Require))
							{
								$Complete = 1;
							}
						}
					}
				}

			}
		}
		unset($item);
	}

	$dal_Player->Building_Progress_Upd($user_id, $progress[0]->BuildingID,$progress[0]->ChurchID,
									$progress[0]->Item1,$Buy1,$progress[0]->Item1Require,$progress[0]->Item1BuyNow,
									$progress[0]->Item2,$Buy2,$progress[0]->Item2Require,$progress[0]->Item2BuyNow,
									$progress[0]->Item3,$Buy3,$progress[0]->Item3Require,$progress[0]->Item3BuyNow,
									$progress[0]->Item4,$Buy4,$progress[0]->Item4Require,$progress[0]->Item4BuyNow,
									$progress[0]->Item5,$Buy5,$progress[0]->Item5Require,$progress[0]->Item5BuyNow,
									$progress[0]->Item6,$Buy6,$progress[0]->Item6Require,$progress[0]->Item6BuyNow,
									$Complete);



	if($_GET['EEGw0J3']=='8T6J50l')
	{//see if the thing is complete
		if($Complete == 1)
		{
			//Comsume items
			$dal_Player->Collections_Upd($user_id,0,$progress[0]->Item1,-($progress[0]->Item1Require));
			$dal_Player->Collections_Upd($user_id,0,$progress[0]->Item2,-($progress[0]->Item2Require));
			$dal_Player->Collections_Upd($user_id,0,$progress[0]->Item3,-($progress[0]->Item3Require));
			$dal_Player->Collections_Upd($user_id,0,$progress[0]->Item4,-($progress[0]->Item4Require));
			$dal_Player->Collections_Upd($user_id,0,$progress[0]->Item5,-($progress[0]->Item5Require));
			$dal_Player->Collections_Upd($user_id,0,$progress[0]->Item6,-($progress[0]->Item6Require));
			//return xml
			$xml = $XML_BEGIN.str_replace('##headerid##','ProgressComplete',$XML_Header);

			//update collections XML
			$result = $dal_Player->Collections_Lst($user_id);
			$xml = $xml.'<Collections>';

			//go through the data and build the xml
			reset($result);
			foreach ($result as $row)
			{
				$xmlrow = '<item id="'.$row->id.
							'" collectionid="'.$row->CollectionID.
							'" itemid="'.$row->Item1Count.
							'" count="'.$row->Item2Count.
							'" />';

				$xml = $xml.$xmlrow;
			}
			//clean up
			unset($row);
			unset($result);
			//close the xml tag
			$xml = $xml.'</Collections>';


		}else //not done
			$xml = $XML_BEGIN.str_replace('##headerid##','ProgressComplete',$XML_Header_Fail);

		//close up XML
		$xml = $xml.$stats->getStatsXML().$XML_END;

		print $xml;
	}

	unset($stats);
}

?>