<?php
/*
Description:    show gift request form

****************History************************************
Date:         	1.17.2011
Author:       	Allen Halsted
Mod:          	Creation
***********************************************************
*/
include_once ($_SERVER['DOCUMENT_ROOT'] . '/gabriel.common/misc/system_start_session.inline.php');
include_once ($_SERVER['DOCUMENT_ROOT'] . '/uriel.life.facebook/lib/config/config.inc.php');
include ($_SERVER['DOCUMENT_ROOT'] . '/gabriel.common/misc/common.func.php');

if(isset($_SESSION['uriel_userid']))
{
	$user_id = $_SESSION['uriel_userid'];
	$facebookID = $_SESSION['xref'];
	$mem_Static = objController::getStaticMEM();
	$dal_Player = objController::getPlayerDAL();
	//record the player has sent a gift
	$ItemID = $_POST['gift'];
	$Source = 2;//Gift
	$ItemType = 2;//Collection
	$IDKey = generatePassword(7,2);
	$dal_Player->Pending_Upd($user_id,$ItemType,$ItemID,$Source,$IDKey,0);

	$excludeids = '';
	$result = $dal_Player->Request_List($user_id);
	if($result)
	{
		reset($result);
		foreach ($result as $row)
		{

			if($excludeids=='')
				$excludeids = $row->FriendsList;
			else
				$excludeids = $excludeids.','.$row->FriendsList;
		}
	}

	$Item = $mem_Static->GetCollectionItem($ItemID);
	if($Item)
	{
		//image of the gift being sent
		$image = 'http://'.$_SERVER['SERVER_NAME'].'/uriel.life.common/public/images/gifts/'.$Item->Image;
		//get a desc
		$giftdesc = $Item->Name;

		//URL to ID GIFT
		$callbackURL = htmlentities('<fb:req-choice url="'.CANVAS_BASE_URL.'?get_gift&Bj9U1oC&QMB149m=QXf1LN6&o5Vx63c='.urlencode($Item->Name).'&mWR8luo='.$Item->id.'&d0LuQVp='.$IDKey.'&Bi1h81K=2&4J4do19=2&D8L6tmO='.$facebookID.'" label="Accept and Play" />');

		$redirectURL = 'http://'.$_SERVER['SERVER_NAME'].'//uriel.life.facebook/';
	}

}

$tmplatename = 'fbml_gift_request.tpl.php';
$tmplatefile = $_SERVER['DOCUMENT_ROOT'] . '/uriel.life.facebook/lib/templates/' . $tmplatename;

?>