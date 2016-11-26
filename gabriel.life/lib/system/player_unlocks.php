<?php
/*
Description:   Verify and record that something has been unlocked
               player uses bookmarks to gain instant access to something
****************History************************************
Date:         	01.26.2011
Author:       	Allen Halsted
Mod:          	Creation
***********************************************************
*/

/* Key
 * Type: o8X1MZi
 * ID: m467dZ0
 * RestrictID: Pbl46In
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


	$restrict = $mem_Static->GetRestriction($_GET['Pbl46In']);

	if($stats->getBookmarks() >= $restrict->BuyNow)
	{
	 	//purchas item both cost and reward
		$stats->removeBookmarks($restrict->BuyNow);
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

		$dal_Player->Unlocks_Upd(0,$user_id,$_GET['o8X1MZi'],$_GET['m467dZ0']);
	}else
	{
		$xml = $XML_BEGIN.str_replace('##headerid##','BuyNow',$XML_Header_Fail);
		$xml = $xml.$XML_END;
	}

	//return result xml to client
	print $xml;

	unset($stats);

}

?>