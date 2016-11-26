<?php
/*
 Description:    Building XML from the player data

 ****************History************************************
 Date:         	1.19.2011
 Author:       	Allen Halsted
 Mod:          	Creation
 ***********************************************************
 */
include ($_SERVER['DOCUMENT_ROOT'].'/gabriel.life/lib/system/xml_templates.func.php');
include_once ($_SERVER['DOCUMENT_ROOT'].'/gabriel.common/misc/system_start_session.inline.php');
include_once ($_SERVER['DOCUMENT_ROOT'].'/gabriel.life/lib/system/global_object_control.php');

class clsPlayerXML {


	private $objDAL;
	private $user_id;

	function __construct() {
		$this->user_id = (isset($_SESSION['uriel_userid'])) ? $_SESSION['uriel_userid'] : '';
		$this->objDAL = objController::getPlayerDAL();
	}

	function __destruct()
 	{
   	}


	public function GetPlayerXML()
	{
		global $XML_BEGIN, $XML_Header,	$XML_END;

		$rtnXML = $XML_BEGIN.str_replace('##headerid##','Player',$XML_Header);
		$rtnXML = $rtnXML.BuildStatsXML();
		$rtnXML = $rtnXML.BuildAchievementsXML();
		$rtnXML = $rtnXML.BuildBuildingProgressXML();
		$rtnXML = $rtnXML.BuildBuildingRechargeXML();
		$rtnXML = $rtnXML.BuildChurchXML();
		$rtnXML = $rtnXML.BuildCollectionsXML();
		$rtnXML = $rtnXML.BuildFriendsXML();
		$rtnXML = $rtnXML.BuildQuestXML();
		$rtnXML = $rtnXML.BuildUnlocksXML();
		$rtnXML = $rtnXML.BuildWishListXML();

		$rtnXML = $rtnXML.$XML_END;

		return $rtnXML;
	}

	public function GetPlayerStatsXML()
	{
		global $XML_BEGIN, $XML_Header,	$XML_END;

		$rtnXML = $XML_BEGIN.str_replace('##headerid##','Player_Stats',$XML_Header);
		$rtnXML = $rtnXML.BuildStatsXML();

		$rtnXML = $rtnXML.$XML_END;

		return $rtnXML;
	}

	public function GetPlayerQuestsXML()
	{
		global $XML_BEGIN, $XML_Header,	$XML_END;

		$rtnXML = $XML_BEGIN.str_replace('##headerid##','Player_Quests',$XML_Header);
		$rtnXML = $rtnXML.BuildQuestXML();

		$rtnXML = $rtnXML.$XML_END;

		return $rtnXML;
	}

	public function GetPlayerUnlocksXML()
	{
		global $XML_BEGIN, $XML_Header,	$XML_END;

		$rtnXML = $XML_BEGIN.str_replace('##headerid##','Player_Unlocks',$XML_Header);
		$rtnXML = $rtnXML.BuildUnlocksXML();

		$rtnXML = $rtnXML.$XML_END;

		return $rtnXML;
	}

	public function GetPlayerFriendsXML()
	{
		global $XML_BEGIN, $XML_Header,	$XML_END;

		$rtnXML = $XML_BEGIN.str_replace('##headerid##','Player',$XML_Header);
		$rtnXML = $rtnXML.BuildStatsXML();
		$rtnXML = $rtnXML.BuildFriendsXML();

		$rtnXML = $rtnXML.$XML_END;

		return $rtnXML;
	}

	public function GetPlayerFriendXML($friendid)
	{
		global $XML_BEGIN, $XML_Header,	$XML_END;

		$rtnXML = $XML_BEGIN.str_replace('##headerid##','Player',$XML_Header);
		$rtnXML = $rtnXML.BuildStatsXML();
		$rtnXML = $rtnXML.BuildFriendXML($friendid);

		$rtnXML = $rtnXML.$XML_END;

		return $rtnXML;
	}


	function BuildStatsXML()
	{

		if(!(isset($_SESSION['experience'])) || $_SESSION['experience'] == '')
		{
			$result = $this->objDAL->Player_Sel($this->user_id);

			$rtnXML = '<stats experince="'.$result[0]->Experience.
					       '" level="'.$result[0]->Level.
					       '" thislevel="'.$result[0]->thislevel.
					       '" nextlevel="'.$result[0]->nextlevel.
					       '" jobapproval="'.$result[0]->JobApproval.
					       '" congergation="'.$result[0]->Congregation.
					       '" capacity="'.$result[0]->Capacity.
					       '" coins="'.$result[0]->Coins.
					       '" bookmarks="'.$result[0]->Bookmarks.
					       '" maxenergy="'.$result[0]->MaxEnergy.
					       '" setup="'.$result[0]->Setup.
						   '" energy="'.$result[0]->Energy.
					       '" />';

			//record Stats into the session
			$_SESSION['experience'] = $result[0]->Experience;
			$_SESSION['level'] = $result[0]->Level;
			$_SESSION['thislevel'] = $result[0]->thislevel;
			$_SESSION['nextlevel'] = $result[0]->nextlevel;
			$_SESSION['jobapproval'] = $result[0]->JobApproval;
			$_SESSION['congergation'] = $result[0]->Congregation;
			$_SESSION['capacity'] = $result[0]->Capacity;
			$_SESSION['coins'] = $result[0]->Coins;
			$_SESSION['bookmarks'] = $result[0]->Bookmarks;
			$_SESSION['maxenergy'] = $result[0]->MaxEnergy;
			$_SESSION['energy'] = $result[0]->Energy;
			$_SESSION['setup'] = $result[0]->Setup;

			unset($result);

		}else
		{
			$rtnXML = '<stats experince="'.$_SESSION['experience'].
					       '" level="'.$_SESSION['level'].
					       '" thislevel="'.$_SESSION['thislevel'].
					       '" nextlevel="'.$_SESSION['nextlevel'].
					       '" jobapproval="'.$_SESSION['jobapproval'].
					       '" congergation="'.$_SESSION['congergation'].
					       '" capacity="'.$_SESSION['capacity'].
					       '" coins="'.$_SESSION['coins'].
					       '" bookmarks="'.$_SESSION['bookmarks'].
					       '" maxenergy="'.$_SESSION['maxenergy'].
					       '" energy="'.$_SESSION['energy'].
						   '" setup="'.$_SESSION['setup'].
					       '" />';
		}


		return $rtnXML;
	}

	function BuildAchievementsXML()
	{
		$result = $this->objDAL->Achievement_Lst($this->user_id);
		$rtnXML = '<Achievements>';

		//go through the data and build the xml
		reset($result);
		foreach ($result as $row)
		{
			$xmlrow = '<achievement id="'.$row->id.
						'" achieveid="'.$row->AchievementID.
						'" count="'.$row->Count.
						'" level1="'.$row->Level1.
						'" level2="'.$row->Level2.
						'" level3="'.$row->Level3.
						'" complete="'.$row->Complete.
						'" active="'.$row->Active.
						'" />';

			$rtnXML = $rtnXML.$xmlrow;
		}
		//clean up
		unset($row);
		unset($result);
		//close the xml tag
		$rtnXML = $rtnXML.'</Achievements>';

		return $rtnXML;
	}

	function BuildBuildingProgressXML()
	{
		$result = $this->objDAL->Building_Progress_Lst($this->user_id);
		$rtnXML = '<BuildingProgress>';

		//go through the data and build the xml
		reset($result);
		foreach ($result as $row)
		{
			$xmlrow = '<progress id="'.$row->id.
						'" building="'.$row->BuildingID.
						'" churchid="'.$row->ChurchID.
						'" item1="'.$row->Item1.
						'" item1done="'.$row->Item1Done.
						'" item1require="'.$row->Item1Require.
						'" item2="'.$row->Item2.
						'" item2done="'.$row->Item2Done.
						'" item2require="'.$row->Item2Require.
						'" item3="'.$row->Item3.
						'" item3done="'.$row->Item3Done.
						'" item3require="'.$row->Item3Require.
						'" item4="'.$row->Item4.
						'" item4done="'.$row->Item4Done.
						'" item4require="'.$row->Item4Require.
						'" item5="'.$row->Item5.
						'" item5done="'.$row->Item5Done.
						'" item5require="'.$row->Item5Require.
						'" item6="'.$row->Item6.
						'" item6done="'.$row->Item6Done.
						'" item6require="'.$row->Item6Require.
						'" complete="'.$row->Complete.
						'" />';

			$rtnXML = $rtnXML.$xmlrow;
		}
		//clean up
		unset($row);
		unset($result);
		//close the xml tag
		$rtnXML = $rtnXML.'</BuildingProgress>';

		return $rtnXML;
	}

	function BuildBuildingRechargeXML()
	{
		$result = $this->objDAL->Building_Recharge_Lst($this->user_id);
		$rtnXML = '<BuildingRecharge>';

		//go through the data and build the xml
		reset($result);
		foreach ($result as $row)
		{

			//minutes since started
			$seconds = time() - strtotime( $row->LastUsed );
			$minutes = $seconds / 60;

			$xmlrow = '<recharge id="'.$row->id.
						'" building="'.$row->BuildingID.
						'" dailyid="'.$row->DailyID.
						'" rechargerate="'.$row->RechargeRate.
						'" lastused="'.$minutes.
						'" />';

			$rtnXML = $rtnXML.$xmlrow;
		}
		//clean up
		unset($row);
		unset($result);
		//close the xml tag
		$rtnXML = $rtnXML.'</BuildingRecharge>';

		return $rtnXML;
	}

	function BuildChurchXML()
	{
		$rtnXML = '<Church>';
		//Get all the church buildings
		$result = $this->objDAL->Church_Buildings_Lst($this->user_id);
		//go through the data and build the xml
		reset($result);
		foreach ($result as $row)
		{
			$xmlrow = '<building id="'.$row->id.
						'" itemtype="'.$row->ItemType.
						'" itemid="'.$row->ItemID.
						'" gridx="'.$row->GridX.
						'" gridy="'.$row->GridY.
						'" subgridx="'.$row->SubGridX.
						'" subgridy="'.$row->SubGridY.
						'" face="'.$row->FacingType.
						'" lastused="'.$row->LastUsed.
						'" capacity="'.$row->Capacity.
						'" row="'.$row->Row.
						'" col="'.$row->Col.
						'" width="'.$row->Width.
						'" height="'.$row->Height.
						'" offx="'.$row->OffsetX.
						'" offy="'.$row->OffsetY.
						'" image="'.$row->Image.
						'" facings="'.$row->Facings.
						'" />';

			$rtnXML = $rtnXML.$xmlrow;
		}
		//clean up
		unset($row);
		unset($result);

		//Get all the church decore
		$result = $this->objDAL->Church_Decore_Lst($this->user_id);
		//go through the data and build the xml
		reset($result);
		foreach ($result as $row)
		{
			$xmlrow = '<decore id="'.$row->id.
						'" itemtype="'.$row->ItemType.
						'" itemid="'.$row->ItemID.
						'" gridx="'.$row->GridX.
						'" gridy="'.$row->GridY.
						'" subgridx="'.$row->SubGridX.
						'" subgridy="'.$row->SubGridY.
						'" face="'.$row->FacingType.
						'" lastused="'.$row->LastUsed.
						'" gridtype="'.$row->GridType.
						'" row="'.$row->Row.
						'" col="'.$row->Col.
						'" width="'.$row->Width.
						'" height="'.$row->Height.
						'" offx="'.$row->OffsetX.
						'" offy="'.$row->OffsetY.
						'" image="'.$row->Image.
						'" facings="'.$row->Facings.
						'" />';

			$rtnXML = $rtnXML.$xmlrow;
		}
		//clean up
		unset($row);
		unset($result);

		//close the xml tag
		$rtnXML = $rtnXML.'</Church>';

		return $rtnXML;
	}

	function BuildCollectionsXML()
	{
		$result = $this->objDAL->Collections_Lst($this->user_id);
		$rtnXML = '<Collections>';

		//go through the data and build the xml
		reset($result);
		foreach ($result as $row)
		{
			$xmlrow = '<item id="'.$row->id.
						'" collectionid="'.$row->CollectionID.
						'" itemid="'.$row->Item1Count.
						'" count="'.$row->Item2Count.
						'" />';

			$rtnXML = $rtnXML.$xmlrow;
		}
		//clean up
		unset($row);
		unset($result);
		//close the xml tag
		$rtnXML = $rtnXML.'</Collections>';

		return $rtnXML;
	}

	function BuildFriendsXML()
	{

		//refresh friends list before trying to read it
		$this->objDAL->Friends_Refresh($this->user_id);
		//get friends list
		$result = $this->objDAL->Friends_Lst($this->user_id);
		$rtnXML = '<Friends>';

		//go through the data and build the xml
		reset($result);
		foreach ($result as $row)
		{
			$xmlrow = '<friend id="'.$row->id.
						'" friendid="'.$row->FriendID.
						'" friendname="'.$row->FriendName.
						'" xref="'.$row->XRef.
						'" level="'.$row->Level.
						'" jobapproval="'.$row->JobApproval.
						'" lastused="'.$row->LastUsed.
						'" >'.BuildWishListXML($row->FriendID).
						'</friend>';
			$rtnXML = $rtnXML.$xmlrow;
		}
		//clean up
		unset($row);
		unset($result);
		//close the xml tag
		$rtnXML = $rtnXML.'</Friends>';

		return $rtnXML;
	}

	function BuildFriendXML($friendid)
	{

		//refresh friends list before trying to read it
		$this->objDAL->Friends_Refresh($this->user_id);
		//get friends list
		$result = $this->objDAL->Friends_Sel($this->user_id,$friendid);

		if(count($result)>0)
		{
			//go through the data and build the xml
			reset($result);
			$row = $result[0];

			$xmlrow = '<friend id="'.$row->id.
						'" friendid="'.$row->FriendID.
						'" friendname="'.$row->FriendName.
						'" xref="'.$row->XRef.
						'" level="'.$row->Level.
						'" jobapproval="'.$row->JobApproval.
						'" lastused="'.$row->LastUsed.
						'" >'.BuildWishListXML($row->FriendID).
						'</friend>';
		}
		//clean up
		unset($row);
		unset($result);
		//close the xml tag
		$rtnXML = '<Friends>'.$xmlrow.'</Friends>';

		return $rtnXML;
	}

	function BuildQuestXML()
	{
		$result = $this->objDAL->Quests_Lst($this->user_id);
		$rtnXML = '<Quests>';

		//go through the data and build the xml
		reset($result);
		foreach ($result as $row)
		{
			$xmlrow = '<quest id="'.$row->id.
						'" questid="'.$row->QuestID.
						'" step1require="'.$row->Step1Require.
						'" step1done="'.$row->Step1Done.
						'" step2require="'.$row->Step2Require.
						'" step2done="'.$row->Step2Done.
						'" step3require="'.$row->Step3Require.
						'" step3done="'.$row->Step3Done.
						'" complete="'.$row->Complete.
						'" />';

			$rtnXML = $rtnXML.$xmlrow;
		}
		//clean up
		unset($row);
		unset($result);
		//close the xml tag
		$rtnXML = $rtnXML.'</Quests>';

		return $rtnXML;
	}

	function BuildUnlocksXML()
	{
		$result = $this->objDAL->Unlocks_Lst($this->user_id);
		$rtnXML = '<Unlocks>';

		//go through the data and build the xml
		reset($result);
		foreach ($result as $row)
		{
			$xmlrow = '<item id="'.$row->id.
						'" itemtype="'.$row->UnlockType.
						'" itemid="'.$row->UnlockID.
						'" />';

			$rtnXML = $rtnXML.$xmlrow;
		}
		//clean up
		unset($row);
		unset($result);
		//close the xml tag
		$rtnXML = $rtnXML.'</Unlocks>';

		return $rtnXML;
	}

	function BuildWishListXML($userid)
	{
		$result = $this->objDAL->Wishlist_Lst($userid);
		$rtnXML = '<WishList>';

		//go through the data and build the xml
		reset($result);
		foreach ($result as $row)
		{
			$xmlrow = '<item id="'.$row->id.
						'" item1="'.$row->item1.
						'" item2="'.$row->item2.
						'" item3="'.$row->item3.
						'" item4="'.$row->item4.
						'" item5="'.$row->item5.
						'" />';

			$rtnXML = $rtnXML.$xmlrow;
		}
		//clean up
		unset($row);
		unset($result);
		//close the xml tag
		$rtnXML = $rtnXML.'</WishList>';

		return $rtnXML;
	}

}



?>