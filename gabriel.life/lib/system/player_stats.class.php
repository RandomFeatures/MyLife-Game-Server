<?php
/*
 Description:    Get/Store Player Stats

 ****************History************************************
 Date:         	1.22.2011
 Author:       	Allen Halsted
 Mod:          	Creation
 ***********************************************************
 */
include_once ($_SERVER['DOCUMENT_ROOT'].'/gabriel.life/lib/system/global_object_control.php');
include_once ($_SERVER['DOCUMENT_ROOT'].'/gabriel.common/misc/system_start_session.inline.php');

class clsPlayerStats {


	private $experience;
	private $level;
	private $thislevel;
	private $nextlevel;
	private $jobapproval;
	private $congergation;
	private $capacity;
	private $coins;
	private $bookmarks;
	private $maxenergy;
	private $energy;
	private $level_up;
	private $setup;
	private $user_id;


	function __construct() {

		//try to load stats from the session
		$this->user_id = (isset($_SESSION['uriel_userid'])) ? $_SESSION['uriel_userid'] : '';
		$this->experience = (isset($_SESSION['experience'])) ? $_SESSION['experience'] : '';
		$this->level = (isset($_SESSION['level'])) ? $_SESSION['level'] : '';
		$this->thislevel = (isset($_SESSION['thislevel'])) ? $_SESSION['thislevel'] : '';
		$this->nextlevel = (isset($_SESSION['nextlevel'])) ? $_SESSION['nextlevel'] : '';
		$this->jobapproval = (isset($_SESSION['jobapproval'])) ? $_SESSION['jobapproval'] : '';
		$this->congergation = (isset($_SESSION['congergation'])) ? $_SESSION['congergation'] : '';
		$this->capacity = (isset($_SESSION['capacity'])) ? $_SESSION['capacity'] : '';
		$this->coins = (isset($_SESSION['coins'])) ? $_SESSION['coins'] : '';
		$this->bookmarks = (isset($_SESSION['bookmarks'])) ? $_SESSION['bookmarks'] : '';
		$this->maxenergy = (isset($_SESSION['maxenergy'])) ? $_SESSION['maxenergy'] : '';
		$this->energy = (isset($_SESSION['energy'])) ? $_SESSION['energy'] : '';
		$this->setup = (isset($_SESSION['setup'])) ? $_SESSION['setup'] : '';
		$this->level_up = false;

	}

	function __destruct()
 	{

   	}

	public function InitPlayerStats()
	{

		//if the stats were not loaded from the session then get them from the db
		if($this->user_id != '')
		{
			//get the stats from the DB
			$objDAL = objController::getPlayerDAL();

			$result = $objDAL->Player_Sel($this->user_id);
			//set them in the session for later use
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
			//set them in the object for current uses
			$this->experience = $result[0]->Experience;
			$this->level = $result[0]->Level;
			$this->thislevel = $result[0]->thislevel;
			$this->nextlevel = $result[0]->nextlevel;
			$this->jobapproval = $result[0]->JobApproval;
			$this->congergation = $result[0]->Congregation;
			$this->capacity = $result[0]->Capacity;
			$this->coins = $result[0]->Coins;
			$this->bookmarks = $result[0]->Bookmarks;
			$this->maxenergy = $result[0]->MaxEnergy;
			$this->energy = $result[0]->Energy;
			$this->setup = $result[0]->Setup;
			unset($result);
		}
	}

	public function UpdatePlayerStats()
	{
		//save any changes to the stata to the db
		if($this->user_id != '')
		{
			$objDAL = objController::getPlayerDAL();

			$objDAL->Player_Stats_Upd($this->user_id,
										$this->level,
										$this->experience,
										$this->coins,
										$this->bookmarks,
										$this->jobapproval,
										$this->congergation,
										$this->capacity,
										$this->energy,
										$this->setup,
										$this->maxenergy);
		}

	}

	public function getStatsXML()
	{
		//This will get returned to the client with almost every call
		if($this->experience == '')
		{
			InitPlayerStats();
		}


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
		return $rtnXML;
	}


	private function calculateXP()
	{
		//see if the player gained a level with the current xp and deal with it
		$rtn = false;

		if($this->experience >=  $this->nextlevel)
		{
			$this->level += 1;

			//update next level
			include ($_SERVER['DOCUMENT_ROOT'].'/gabriel.life/lib/dal/dao_static.class.php');
			$objDAL = new daoStatic(DB_HOST, DB_USER, DB_PASS, DB_STATIC);
			$result = $objDAL->Level_Progression_sel($this->level+1);

			$this->thislevel = $this->nextlevel;
			$this->nextlevel = $result[0]->XP;
			$_SESSION['level'] = $this->level;
			$_SESSION['thislevel'] = $this->thislevel;
			$_SESSION['nextlevel'] = $this->nextlevel;
			$rtn = true;
		}
	}

	private function calculateJA($ActivityJA)
	{
		/*
		 * can only gain a % of remaining JA
		 * so it gets harder and harder to advance as get higher.
		 * Force the rounding up
		 */

		//ceiling(JA += ActivityJA% * (100 - JA))
		return ceil($ActivityJA / 100) * (100 - $this->jobapproval);
	}

	private function calculateCoins($ActivityCoins)
	{
		/*
		 * Coin rewards are always based on the current size of the congeration
		 */
		//ceiling(Coins += ActivityCoins * (Congregation * JA%))
		return ceil($ActivityCoins * ($this->congregation * ($this->jobapproval /100)));
	}

	//let things outside this class know about the level up
	public function checkLevelUp()
	{
		return $this->level_up;
	}


	public function addReward($Experience,$Coins,$Bookmarks,$JobApproval,$Congregation,$Capacity, $Energy, $MaxEnergy)
	{
		//do all the rewards at once to cut down on DB traffic
		$this->bookmarks += $Bookmarks;
		$this->capacity += $Capacity;
		if($Coins > 0) $this->coins += $this->calculateCoins($Coins);

		if(($this->congregation + $Congregation)>$this->capacity)
			$this->congregation = $this->capacity;//dont go above capacity cap
		else
			$this->congregation += $Congregation;

		$this->energy += $Energy;
		$this->experience += $Experience;
		if($JobApproval > 0) $this->jobapproval += $this->calculateJA($JobApproval);
		$this->maxenergy += $MaxEnergy;

		$_SESSION['bookmarks'] = $this->bookmarks;
		$_SESSION['capacity'] = $this->capacity;
		$_SESSION['coins'] = $this->coins;
		$_SESSION['congregation'] = $this->congregation;
		$_SESSION['energy'] = $this->energy;
		$_SESSION['experience'] = $this->experience;
		$_SESSION['jobapproval'] = $this->jobapproval;
		$_SESSION['maxenergy'] = $this->maxenergy;

		$this->level_up = $this->calculateXP();

		$this->UpdatePlayerStats();
	}

	/*
	 * Experience
	 */
	public function getExperince()
	{
		if($this->experience == '')
		{
			InitPlayerStats();
		}

		return $this->experience;
	}

	public function addExperince($value)
	{
		$this->experience += $value;

		$_SESSION['experience'] = $this->experience;

		$this->level_up = $this->calculateXP();

		$this->UpdatePlayerStats();
	}

	/*
	 * Level
	 */
	public function getLevel()
	{
		if($this->level == '')
		{
			InitPlayerStats();
		}

		return $this->level;
	}

	public function addLevel($value)
	{
		$this->level += $value;

		$_SESSION['level'] = $this->level;
		$this->UpdatePlayerStats();
	}

	/*
	 * Setup
	 */
	public function getSetup()
	{
		if($this->setup == '')
		{
			InitPlayerStats();
		}

		return $this->setup;
	}

	public function addSetup()
	{
		if($this->setup < 3)
		{
			$this->setup += 1;

			$_SESSION['setup'] = $this->setup;
			$this->UpdatePlayerStats();
		}
	}

	/*
	 * Coins
	 */
	public function getCoins()
	{
		if($this->coins == '')
		{
			InitPlayerStats();
		}

		return $this->coins;
	}

	public function addCoins($value)
	{
		$this->coins += $this->calculateCoins($value);

		$_SESSION['coins'] = $this->coins;
		$this->UpdatePlayerStats();
	}

	public function removeCoins($value)
	{
		$this->coins -= $value;

		$_SESSION['coins'] = $this->coins;
		$this->UpdatePlayerStats();
	}

	/*
	 * Bookmarks
	 */
	public function getBookmarks()
	{
		if($this->bookmarks == '')
		{
			InitPlayerStats();
		}

		return $this->bookmarks;
	}

	public function addBookmarks($value)
	{
		$this->bookmarks += $value;

		$_SESSION['bookmarks'] = $this->bookmarks;
		$this->UpdatePlayerStats();
	}

	public function removeBookmarks($value)
	{
		$this->bookmarks -= $value;

		$_SESSION['bookmarks'] = $this->bookmarks;
		$this->UpdatePlayerStats();
	}

	/*
	 * Job Approval
	 */
	public function getJobApproval()
	{
		if($this->jobapproval == '')
		{
			InitPlayerStats();
		}

		return $this->jobapproval;
	}

	public function addJobApproval($value)
	{
		$this->jobapproval += $this->calculateJA($value);

		$_SESSION['jobapproval'] = $this->jobapproval;
		$this->UpdatePlayerStats();
	}

	public function removeJobApproval($value)
	{
		$this->jobapproval -= $value;

		$_SESSION['jobapproval'] = $this->jobapproval;
		$this->UpdatePlayerStats();
	}

	/*
	 * Congregation
	 */
	public function getCongregation()
	{
		if($this->congregation == '')
		{
			InitPlayerStats();
		}

		return $this->congregation;
	}

	public function addCongregation($value)
	{
		if(($this->congregation + $value)>$this->capacity)
			$this->congregation = $this->capacity;//dont go above capacity cap
		else
			$this->congregation += $value;

		$_SESSION['congregation'] = $this->congregation;
		$this->UpdatePlayerStats();
	}

	public function removeCongregation($value)
	{
		$this->congregation -= $value;

		$_SESSION['congregation'] = $this->congregation;
		$this->UpdatePlayerStats();
	}

	/*
	 * Capacity
	 */
	public function getCapacity()
	{
		if($this->capacity == '')
		{
			InitPlayerStats();
		}

		return $this->capacity;
	}

	public function addCapacity($value)
	{
		$this->capacity += $value;

		$_SESSION['capacity'] = $this->capacity;
		$this->UpdatePlayerStats();
	}

	public function removeCapacity($value)
	{
		$this->capacity -= $value;

		$_SESSION['capacity'] = $this->capacity;
		$this->UpdatePlayerStats();
	}

	/*
	 * Energy
	 */
	public function getEnergy()
	{
		if($this->energy == '')
		{
			InitPlayerStats();
		}

		return $this->energy;
	}

	public function addEnergy($value)
	{
		$this->energy += $value;

		$_SESSION['energy'] = $this->energy;
		$this->UpdatePlayerStats();
	}

	public function removeEnergy($value)
	{
		$this->energy -= $value;

		$_SESSION['energy'] = $this->energy;
		$this->UpdatePlayerStats();
	}

	/*
	 * MaxEnergy
	 */
	public function getMaxEnergy()
	{
		if($this->maxenergy == '')
		{
			InitPlayerStats();
		}

		return $this->maxenergy;
	}

	public function addMaxEnergy($value)
	{
		$this->maxenergy += $value;

		$_SESSION['maxenergy'] = $this->maxenergy;
		$this->UpdatePlayerStats();
	}
}



?>