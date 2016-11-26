<?php


/* Key
 * Xref: t7KL116 //this is me
 * FriendID: D8L6tmO //id of the friend
 */
//store for later use JIC
$_SESSION['pending_friend_'.GAME_ID] = $_GET['D8L6tmO'];		
//connect teh friends if I can
if($authorized)
{
	include ($_SERVER['DOCUMENT_ROOT'].'/gabriel.life/lib/system/player_friends.func.php');
	
	$friendID = $_GET['D8L6tmO'];
	//get friend data from facebook
	$friend = json_decode(file_get_contents('http://graph.facebook.com/'.$friendID));
	//get friend picture from facebook
	$friendImage = 'http://graph.facebook.com/'.$friendID.'/picture'; 
	$friendName = $friend->name;
	
    ConnectFriends($friendID,$facebookID);
	unset($_SESSION['pending_friend_'.GAME_ID]);
	
	$headmessage = 'A '.$_GET['o5Vx63c'].' has been added to your account.';
	$divtplname = 'div_gift_accepted.tpl.php';
	$giftaccepted = $_SERVER['DOCUMENT_ROOT'] . '/uriel.life.facebook/lib/templates/' . $divtplname;  
	
}


?>