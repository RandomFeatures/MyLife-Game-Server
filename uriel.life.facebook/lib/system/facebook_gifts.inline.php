<?php
	/* Key
	 * PendingKey: d0LuQVp
	 * PendingType: QMB149m
	 *  CollectMyReward: gvFJ23Z
	 *  CollectGift: QXf1LN6  
	 * ItemName: o5Vx63c 	 
	 */

include ($_SERVER['DOCUMENT_ROOT'].'/gabriel.life/lib/system/player_pending.func.php');

//store for later use JIC
$_SESSION['pending_gift_'.GAME_ID] = $_GET['d0LuQVp'];		

//connect teh friends if I can
if($authorized)
{
	
	$user_id = $_SESSION['uriel_userid'];
	$gotGift = false;
	switch($_GET['QMB149m'])
	{
		case 'gvFJ23Z'://Collect My Reward
			//get the reward that is only for me
			 $gotGift = CollectMyReward($user_id,$_GET['d0LuQVp']);
			break;
		case 'QXf1LN6'://Collect A Gift
			//get the reward that could be for many people
			$gotGift = CollectGift($user_id,$_GET['d0LuQVp']);
			break;
	}
	
	if($gotGift)
	{
		$headmessage = 'A '.$_GET['o5Vx63c'].' has been added to your account.';
		$divtplname = 'div_gift_accepted.tpl.php';
		
		
		$ItemType = $_GET['4J4do19'];
		$ItemID= $_GET['mWR8luo'];
		
		$item = LookupItem($ItemType,$ItemID);
		
		$giftImage ='http://'.$_SERVER['SERVER_NAME'].'/uriel.life.common/public/images/gifts/'.$item->Image;
		$giftDesc = $item->Name;
		
		$friendID = $_GET['D8L6tmO'];
		//get friend data from facebook
		$friend = json_decode(file_get_contents('http://graph.facebook.com/'.$friendID));
		//get friend picture from facebook
		$friendImage = 'http://graph.facebook.com/'.$friendID.'/picture'; 
		$friendName = $friend->name;
		
		unset($item);
		unset($friend);
		unset($_SESSION['pending_gift_'.GAME_ID]);
	}else 
	{
		$headmessage="This gift is no longer available!";
		$divtplname = 'div_gift_denied.tpl.php';
	}
	
	$giftaccepted = $_SERVER['DOCUMENT_ROOT'] . '/uriel.life.facebook/lib/templates/' . $divtplname;  
	
}


?>

