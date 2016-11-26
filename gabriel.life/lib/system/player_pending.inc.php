<?php
/*
Description:   Collect Pending Items
                
****************History************************************
Date:         	01.25.2011
Author:       	Allen Halsted
Mod:          	Creation
***********************************************************
*/

/* Key
 * PendingKey: d0LuQVp
 * PendingType: QMB149m
 * 	AddReward: QaedR7D
 *  CollectMyReward: gvFJ23Z
 * 	ListGifts: N3ErpPg
 *  CollectGift: QXf1LN6  
 * ItemID: mWR8luo
 * Source: Bi1h81K
 * ItemType: 4J4do19
 * ItemName: o5Vx63c 
 * FriendID: D8L6tmO	 
 */

include_once ($_SERVER['DOCUMENT_ROOT'].'/gabriel.common/misc/system_start_session.inline.php');
include_once ($_SERVER['DOCUMENT_ROOT'].'/gabriel.life/lib/system/player_pending.func.php');


if(isset($_SESSION['uriel_userid']))
{
						
	$user_id = $_SESSION['uriel_userid'];
	
	switch($_GET['QMB149m'])
	{
		case 'QaedR7D'://Add Pending Reward
			
			$IDKey = AddPendingGift($user_id,$_GET['mWR8luo'],$_GET['Bi1h81K'],$_GET['4J4do19']);
			
			print $IDKey;
			
			break;
		case 'gvFJ23Z'://Collect My Reward
			
			CollectMyReward($user_id,$_GET['d0LuQVp']);
				
			break;
		case 'QXf1LN6'://Collect A Gift
			
			CollectGift($user_id,$_GET['d0LuQVp']);

			break;
		case 'N3ErpPg'://List Gifts
			break;
	}
	
}

?>
