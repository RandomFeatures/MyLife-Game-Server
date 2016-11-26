<?php
/*
 Description:    Building XML from the static data

 ****************History************************************
 Date:         	1.19.2011
 Author:       	Allen Halsted
 Mod:          	Creation
 ***********************************************************
 */
include ($_SERVER['DOCUMENT_ROOT'].'/gabriel.life/lib/config/config.inc.php');
include ($_SERVER['DOCUMENT_ROOT'].'/gabriel.life/lib/dal/dao_static.class.php');
include ($_SERVER['DOCUMENT_ROOT'].'/gabriel.life/lib/system/xml_templates.func.php');


class clsStaticXML {


	private $objDAL;
	private $mcache;

	function __construct() {
		$this->mcache = new Memcached();
		$this->mcache->addServer(MC_SERVER,MC_PORT);
	}

	function __destruct()
 	{
    	if (isset($this->objDAL))
 			unset($this->objDAL);
 		unset($this->mcache);
   	}

   	function _getDaoStatic()
   	{
   		if (!isset($this->objDAL))
   			$this->objDAL = new daoStatic(DB_HOST, DB_USER, DB_PASS, DB_STATIC);

   		return $this->objDAL;

   	}

	public function GetBuildingsXML()
	{
		global $XML_BEGIN, $XML_Header,	$XML_END;

		//check memcache first
		if (!($rtnXML = $this->mcache->get('buildings')))
		{
			//build xml
			$rtnXML = $XML_BEGIN.str_replace('##headerid##','Buildings',$XML_Header);
			$rtnXML = $rtnXML.BuildBuildingsXML();
			$rtnXML = $rtnXML.$XML_END;

			//add to Memcached
			$this->mcache->set('buildings', $rtnXML);
		}
		return $rtnXML;
	}

	public function GetCollectionsXML()
	{
		global $XML_BEGIN, $XML_Header,	$XML_END;

		//check memcache first
		if (!($rtnXML = $this->mcache->get('collections')))
		{
			//build xml
			$rtnXML = $XML_BEGIN.str_replace('##headerid##','Collections',$XML_Header);
			$rtnXML = $rtnXML.BuildCollectionsXML();
			$rtnXML = $rtnXML.$XML_END;

			//add to Memcached
			$this->mcache->set('collections', $rtnXML);
		}
		return $rtnXML;
	}

	public function GetMissionsXML()
	{
		global $XML_BEGIN, $XML_Header,	$XML_END;

		//check memcache first
		if (!($rtnXML = $this->mcache->get('missions')))
		{
			//build xml
			$rtnXML = $XML_BEGIN.str_replace('##headerid##','Missions',$XML_Header);
			$rtnXML = $rtnXML.BuildMissionsXML();
			$rtnXML = $rtnXML.$XML_END;

			//add to Memcached
			$this->mcache->set('missions', $rtnXML);
		}
		return $rtnXML;
	}

	public function GetQuestsXML()
	{
		global $XML_BEGIN, $XML_Header,	$XML_END;

		//check memcache first
		if (!($rtnXML = $this->mcache->get('quests')))
		{
			//build xml
			$rtnXML = $XML_BEGIN.str_replace('##headerid##','Quests',$XML_Header);
			$rtnXML = $rtnXML.BuildQuestsXML();
			$rtnXML = $rtnXML.$XML_END;

			//add to Memcached
			$this->mcache->set('quests', $rtnXML);
		}
		return $rtnXML;
	}

	public function GetStoreXML()
	{
		global $XML_BEGIN, $XML_Header,	$XML_END;

		//check memcache first
		if (!($rtnXML = $this->mcache->get('store')))
		{
			//build xml
			$rtnXML = $XML_BEGIN.str_replace('##headerid##','Store',$XML_Header);
			$rtnXML = $rtnXML.'<Store>';
			$rtnXML = $rtnXML.BuildStoreDecoreXML();
			$rtnXML = $rtnXML.BuildStoreBuildingsXML();
			$rtnXML = $rtnXML.'</Store>';
			$rtnXML = $rtnXML.$XML_END;

			//add to Memcached
			$this->mcache->set('store', $rtnXML);
		}
		return $rtnXML;
	}



	function BuildBuildingsXML()
	{
		//get the raw data
		$result = $this->_getDaoStatic()->Buildings_lst();
		$rtnXML = '<Buildings>';

		//go through the data and build the xml
		reset($result);
		foreach ($result as $row)
		{
			$xmlrow = '<building id="'.$row->id.
						'" name="'.$row->Name.
						'" desc="'.$row->Dscrpt.
						'" capacity="'.$row->Capacity.
						'" row="'.$row->Row.
						'" Col="'.$row->Col.
						'" width="'.$row->Width.
						'" height="'.$row->Height.
						'" offx="'.$row->OffsetX.
						'" offy="'.$row->OffsetY.
						'" sell="'.$row->SellValue.
						'" image="'.$row->Image.
						'" facings="'.$row->Facings.
						'" >';
			$xmlrow = $xmlrow.BuildBuildingDailiesXML($row->id);
			$xmlrow = $xmlrow.BuildBuildingRequirementsXML($row->id);
			$rtnXML = $rtnXML.$xmlrow.'</building>';
		}
		//clean up
		unset($row);
		unset($result);
		//close the xml tag
		$rtnXML = $rtnXML.'</Buildings>';

		return $rtnXML;
	}

	function BuildBuildingDailiesXML($buildingid)
	{
		$result = $this->_getDaoStatic()->Building_Dailies_lst($buildingid);
		$rtnXML = '<BDailies>';

		//go through the data and build the xml
		reset($result);
		foreach ($result as $row)
		{
			$xmlrow = '<daily id="'.$row->id.
						'" buildid="'.$row->BuildingID.
						'" dailyid="'.$row->DailyID.
						'" name="'.$row->Name.
						'" desc="'.$row->Dscrpt.
						'" recharge="'.$row->RechargeTime.
						'" busy="'.$row->BusyTime.
						'" rewardid="'.$row->RewardID.
						'" coins="'.$row->Coins.
						'" bookmarks="'.$row->Bookmarks.
						'" jobapproval="'.$row->JobApproval.
						'" xp="'.$row->Xp.
						'" />';

			$rtnXML = $rtnXML.$xmlrow;
		}
		//clean up
		unset($row);
		unset($result);
		//close the xml tag
		$rtnXML = $rtnXML.'</BDailies>';

		return $rtnXML;
	}

	function BuildBuildingRequirementsXML($buildingid)
	{
		$result = $this->_getDaoStatic()->Building_Requirements_lst($buildingid);
		$rtnXML = '<Requirements>';

		//go through the data and build the xml
		reset($result);
		foreach ($result as $row)
		{
			$xmlrow = '<requirement id="'.$row->id.
						'" buildid="'.$row->BuildingID.
						'" collectid="'.$row->CollectionID.
						'" count="'.$row->ItemCount.
						'" buynow="'.$row->BuyNow.
						'" />';

			$rtnXML = $rtnXML.$xmlrow;
		}
		//clean up
		unset($row);
		unset($result);
		//close the xml tag
		$rtnXML = $rtnXML.'</Requirements>';

		return $rtnXML;
	}


	function BuildCollectionsXML()
	{
		//get the raw data
		$result = $this->_getDaoStatic()->Collections_lst();
		$rtnXML = '<Collections>';

		//go through the data and build the xml
		reset($result);
		foreach ($result as $row)
		{
			$xmlrow = '<collection id="'.$row->id.
						'" name="'.$row->Name.
						'" rewardid="'.$row->RewardID.
						'" coins="'.$row->Coins.
						'" bookmarks="'.$row->Bookmarks.
						'" jobapproval="'.$row->JobApproval.
						'" xp="'.$row->Xp.
						'" >';
			$xmlrow = $xmlrow.BuildCollectionItemsXML($row->id);
			$rtnXML = $rtnXML.$xmlrow.'</collection>';
		}
		//clean up
		unset($row);
		unset($result);
		//close the xml tag
		$rtnXML = $rtnXML.'</Collections>';

		return $rtnXML;
	}



	function BuildCollectionItemsXML($collectid)
	{
		$result = $this->_getDaoStatic()->Collections_Items_lst($collectid);
		$rtnXML = '<Items>';

		//go through the data and build the xml
		reset($result);
		foreach ($result as $row)
		{
			$xmlrow = '<item id="'.$row->id.
						'" collectid="'.$row->CollectionID.
						'" name="'.$row->Name.
						'" image="'.$row->Image.
						'" level="'.$row->Level.
						'" itemnum="'.$row->ItemNumber.
						'" droprate="'.$row->DropRate.
						'" />';

			$rtnXML = $rtnXML.$xmlrow;
		}
		//clean up
		unset($row);
		unset($result);
		//close the xml tag
		$rtnXML = $rtnXML.'</Items>';

		return $rtnXML;
	}

	function BuildMissionsXML()
	{
		$result = $this->_getDaoStatic()->Missions_lst();
		$rtnXML = '<Missions>';

		//go through the data and build the xml
		reset($result);
		foreach ($result as $row)
		{
			$xmlrow = '<mission id="'.$row->id.
						'" name="'.$row->Name.
						'" desc="'.$row->Dscrpt.
						'" image="'.$row->Image.
						'" resid="'.$row->RestrictionID.
						'" resdesc="'.$row->restrictDesc.
						'" stattype="'.$row->StatType.
						'" statid="'.$row->StatID.
						'" buynow="'.$row->BuyNow.
						'" />';

			$rtnXML = $rtnXML.$xmlrow;
		}
		//clean up
		unset($row);
		unset($result);
		//close the xml tag
		$rtnXML = $rtnXML.'</Missions>';

		return $rtnXML;
	}

	function BuildQuestsXML()
	{
		//get the raw data
		$result = $this->_getDaoStatic()->Quests_lst();
		$rtnXML = '<Quests>';

		//go through the data and build the xml
		reset($result);
		foreach ($result as $row)
		{
			$xmlrow = '<quest id="'.$row->id.
						'" name="'.$row->Name.
						'" desc="'.$row->Dscrpt.
						'" steps="'.$row->Steps.
						'" rewardid="'.$row->RewardID.
						'" hint="'.$row->Hint.

						'" coins="'.$row->Coins.
						'" bookmarks="'.$row->Bookmarks.
						'" jobapproval="'.$row->JobApproval.
						'" xp="'.$row->Xp.
						'" >';
			$xmlrow = $xmlrow.BuildQuestStepsXML($row->id);
			$rtnXML = $rtnXML.$xmlrow.'</quest>';
		}
		//clean up
		unset($row);
		unset($result);
		//close the xml tag
		$rtnXML = $rtnXML.'</Quests>';

		return $rtnXML;
	}


	function BuildQuestStepsXML($questid)
	{
		$result = $this->_getDaoStatic()->Quest_Steps_lst($questid);
		$rtnXML = '<Steps>';

		//go through the data and build the xml
		reset($result);
		foreach ($result as $row)
		{
			$xmlrow = '<step id="'.$row->id.
						'" questid="'.$row->QuestID.
						'" desc="'.$row->Dscrpt.
						'" required="'.$row->Required.
						'" number="'.$row->StepNumber.
						'" buynow="'.$row->BuyNow.
						'" image="'.$row->Image.
						'" />';

			$rtnXML = $rtnXML.$xmlrow;
		}
		//clean up
		unset($row);
		unset($result);
		//close the xml tag
		$rtnXML = $rtnXML.'</Steps>';

		return $rtnXML;
	}

	function BuildStoreBuildingsXML()
	{
		$result = $this->_getDaoStatic()->Store_Buildings_lst();
		$rtnXML = '<Building>';

		//go through the data and build the xml
		reset($result);
		foreach ($result as $row)
		{
			$xmlrow = '<item id="'.$row->id.
						'" itemtype="'.$row->ItemType.
						'" itemid="'.$row->ItemID.
						'" desc="'.$row->Dscrpt.
						'" icon="'.$row->StoreIcon.
						'" salened="'.$row->SaleEndDate.
						'" cost="'.$row->Cost.
						'" costtype="'.$row->CostType.
						'" capacity="'.$row->capacity.
						'" row="'.$row->Row.
						'" col="'.$row->Col.
						'" width="'.$row->Width.
						'" height="'.$row->Height.
						'" offx="'.$row->OffsetX.
						'" offy="'.$row->OffsetY.
						'" image="'.$row->Image.
						'" facings="'.$row->Facings.

						'" resid="'.$row->RestrictionID.
						'" resdesc="'.$row->restrictDesc.
						'" stattype="'.$row->StatType.
						'" statid="'.$row->StatID.
						'" buynow="'.$row->BuyNow.

						'" rewardid="'.$row->RewardID.
						'" coins="'.$row->Coins.
						'" bookmarks="'.$row->Bookmarks.
						'" jobapproval="'.$row->JobApproval.
						'" xp="'.$row->Xp.
						'" />';

			$rtnXML = $rtnXML.$xmlrow;
		}
		//clean up
		unset($row);
		unset($result);
		//close the xml tag
		$rtnXML = $rtnXML.'</Building>';

		return $rtnXML;
	}


	function BuildStoreDecoreXML()
	{
		$result = $this->_getDaoStatic()->Store_Decore_lst();
		$rtnXML = '<Decore>';

		//go through the data and build the xml
		reset($result);
		foreach ($result as $row)
		{
			$xmlrow = '<item id="'.$row->id.
						'" itemtype="'.$row->ItemType.
						'" itemid="'.$row->ItemID.
						'" desc="'.$row->Dscrpt.
						'" icon="'.$row->StoreIcon.
						'" salened="'.$row->SaleEndDate.
						'" cost="'.$row->Cost.
						'" costtype="'.$row->CostType.
						'" gridtype="'.$row->GridType.
						'" row="'.$row->Row.
						'" col="'.$row->Col.
						'" width="'.$row->Width.
						'" height="'.$row->Height.
						'" offx="'.$row->OffsetX.
						'" offy="'.$row->OffsetY.
						'" image="'.$row->Image.
						'" facings="'.$row->Facings.

						'" resid="'.$row->RestrictionID.
						'" resdesc="'.$row->restrictDesc.
						'" stattype="'.$row->StatType.
						'" statid="'.$row->StatID.
						'" buynow="'.$row->BuyNow.

						'" rewardid="'.$row->RewardID.
						'" coins="'.$row->Coins.
						'" bookmarks="'.$row->Bookmarks.
						'" jobapproval="'.$row->JobApproval.
						'" xp="'.$row->Xp.
						'" />';

			$rtnXML = $rtnXML.$xmlrow;
		}
		//clean up
		unset($row);
		unset($result);
		//close the xml tag
		$rtnXML = $rtnXML.'</Decore>';

		return $rtnXML;
	}




}



?>