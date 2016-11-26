<?php
/*
 Description:    Store/Fetch basic static data in memcache

 ****************History************************************
 Date:         	1.19.2011
 Author:       	Allen Halsted
 Mod:          	Creation
 ***********************************************************
 */
include_once ($_SERVER['DOCUMENT_ROOT'].'/gabriel.life/lib/config/static.config.inc.php');
include_once ($_SERVER['DOCUMENT_ROOT'].'/gabriel.life/lib/dal/dao_static.class.php');

class clsStaticMem {


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

   	public function &GetBuildingDaily($buildingid,$dailyid)
	{
		$key = 'building:'.$buildingid.'daily:'.$dailyid;

		if (!($result = $this->mcache->get($key)))
		{

			$result = $this->_getDaoStatic()->Building_Daily_sel($buildingid,$dailyid);

			//add to Memcacheddao
			$this->mcache->set($key, $result);
		}
		return $result;
	}

	public function &GetQuestTrigger($type,$action)
	{
		$key = 'triggertype:'.$type.'action'.$action;

		if (!($result = $this->mcache->get($key)))
		{

			$result = _getDaoStatic()->Quest_Trigger_sel($type,$action);

			//add to Memcacheddao
			$this->mcache->set($key, $result);
		}
		return $result;
	}

	public function &GetQuest($questid)
	{
		$key = 'quest:'.$questid;

		if (!($result = $this->mcache->get($key)))
		{

			$result = _getDaoStatic()->Quest_Trigger_sel($type,$action);

			//add to Memcacheddao
			$this->mcache->set($key, $result);
		}
		return $result;
	}

	public function &GetBuildingRequirmentsList($buildingid)
	{
		$key = 'buildingrequire:'.$buildingid;

		if (!($result = $this->mcache->get($key)))
		{

			$result = _getDaoStatic()->Building_Requirements_lst($buildingid);

			//add to Memcacheddao
			$this->mcache->set($key, $result);
		}
		return $result;
	}


	public function &GetDaily($dailyid)
	{
		$key = 'daily:'.$dailyid;



		if (!($result = $this->mcache->get($key)))
		{

			$result = _getDaoStatic()->Dailies_sel($dailyid);

			//add to Memcached
			$this->mcache->set($key, $result[0]);
		}
		return $result;
	}

	public function &GetRewardList($Level)
	{
		$key = 'rewarditem:'.$Level;

		if (!($result = $this->mcache->get($key)))
		{

			$result = _getDaoStatic()->Collections_Reward_lst($Level);

			//add to Memcached
			$this->mcache->set($key, $result);
		}
		return $result;
	}

	public function &GetGiftList()
	{
		$key = 'giftlist';

		if (!($result = $this->mcache->get($key)))
		{

			$result = _getDaoStatic()->Collections_Gift_lst();

			//add to Memcached
			$this->mcache->set($key, $result);
		}
		return $result;
	}


	public function &GetCollectionItem($Item)
	{
		$key = 'collectionitem:'.$Item;

		if (!($result = $this->mcache->get($key)))
		{

			$rtn = _getDaoStatic()->Collections_Items_sel($Item);

			//add to Memcached
			$this->mcache->set($key, $rtn[0]);
			$result = $rtn[0];
		}
		return $result;
	}

	public function &GetBuilding($BuildingID)
	{
		$key = 'building:'.$BuildingID;

		if (!($result = $this->mcache->get($key)))
		{

			$rtn = _getDaoStatic()->Buildings_sel($BuildingID);

			//add to Memcached
			$this->mcache->set($key, $rtn[0]);
			$result = $rtn[0];
		}
		return $result;
	}

	public function &GetDecore($DecoreID)
	{
		$key = 'decore:'.$DecoreID;

		if (!($result = $this->mcache->get($key)))
		{

			$rtn = _getDaoStatic()->Decore_sel($DecoreID);

			//add to Memcached
			$this->mcache->set($key, $rtn[0]);
			$result = $rtn[0];
		}
		return $result;
	}

	public function &GetStoreItem($storeID)
	{
		$key = 'store:'.$storeID;

		if (!($result = $this->mcache->get($key)))
		{

			$rtn = _getDaoStatic()->Store_sel($storeID);

			//add to Memcached
			$this->mcache->set($key, $rtn[0]);
			$result = $rtn[0];
		}
		return $result;
	}

	public function &GetStoreDecore()
	{
		$key = 'storedecore';

		if (!($result = $this->mcache->get($key)))
		{

			$result = _getDaoStatic()->Store_Decore_lst();

			//add to Memcached
			$this->mcache->set($key, $result);
		}
		return $result;
	}

	public function &GetStoreBuildings()
	{
		$key = 'storebuildings';

		if (!($result = $this->mcache->get($key)))
		{

			$result = _getDaoStatic()->Store_Buildings_lst();

			//add to Memcached
			$this->mcache->set($key, $result);
		}
		return $result;
	}

	public function &GetRestriction($resID)
	{
		$key = 'restriction:'.$storeID;

		if (!($result = $this->mcache->get($key)))
		{

			$rtn = _getDaoStatic()->Restrictions_sel($resID);

			//add to Memcached
			$this->mcache->set($key, $rtn[0]);
			$result = $rtn[0];
		}
		return $result;
	}

	public function &GetGameInit($source)
	{
		$key = 'gameinit:'.$source;

		if (!($result = $this->mcache->get($key)))
		{

			$rtn = _getDaoStatic()->Game_Init($source);

			//add to Memcached
			$this->mcache->set($key, $rtn[0]);
			$result = $rtn[0];
		}
		return $result;
	}

}

?>