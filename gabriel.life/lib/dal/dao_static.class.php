<?php
/*
 Description:    Data Access Object for Game

 ****************History************************************
 Date:         	1.18.2011
 Author:       	Allen Halsted
 Mod:          	Creation
 ***********************************************************
 */

include_once ($_SERVER['DOCUMENT_ROOT'].'/gabriel.common/libs/dal/dao_base.class.php');

 class daoStatic extends daoBase
 {


       	// Constructor
		function __construct($dbHost, $dbUser, $dbPass, $dbDatabase)
		{
			daoBase::__construct($dbHost, $dbUser, $dbPass, $dbDatabase);
		}

		function __destruct()
 		{
       		daoBase::__destruct();
   		}


 		public function &Buildings_lst()
		{
			$strStoredProc = 'dsp_Buildings_lst';
			$strParam = '()' ;

          	$rtn = $this->Query($strStoredProc, $strParam);
			return $rtn;
		}

		public function &Buildings_sel($buildingid)
		{
			$strStoredProc = 'dsp_Buildings_sel';
			$strParam = '('.$buildingid.')' ;

          	$rtn = $this->Query($strStoredProc, $strParam);
			return $rtn;
		}


 		public function &Building_Dailies_lst($buildingid)
		{
			$strStoredProc = 'dsp_Building_Dailies_lst';
			$strParam = '('.$buildingid.')' ;

          	$rtn = $this->Query($strStoredProc, $strParam);
			return $rtn;
		}

 		public function &Building_Daily_sel($buildingid,$dailyid)
		{
			$strStoredProc = 'dsp_Building_Daily_sel';
			$strParam = '('.$buildingid.','.$dailyid.')' ;

          	$rtn = $this->Query($strStoredProc, $strParam);
			return $rtn;
		}

 		public function &Building_Requirements_lst($buildingid)
		{
			$strStoredProc = 'dsp_Building_Requirements_lst';
			$strParam = '('.$buildingid.')' ;

          	$rtn = $this->Query($strStoredProc, $strParam);
			return $rtn;
		}

 		public function &Collections_lst()
		{
			$strStoredProc = 'dsp_Collections_lst';
			$strParam = '()' ;

          	$rtn = $this->Query($strStoredProc, $strParam);
			return $rtn;
		}

  		public function &Collections_Items_lst($collectionid)
		{
			$strStoredProc = 'dsp_Collections_Items_lst';
			$strParam = '('.$collectionid.')' ;

          	$rtn = $this->Query($strStoredProc, $strParam);
			return $rtn;
		}

		public function &Collections_Items_sel($id)
		{
			$strStoredProc = 'dsp_Collections_Items_sel';
			$strParam = '('.$id.')' ;

          	$rtn = $this->Query($strStoredProc, $strParam);
			return $rtn;
		}

		public function &Collections_Reward_lst($level)
		{
			$strStoredProc = 'dsp_Collections_Reward_lst';
			$strParam = '('.$level.')' ;

          	$rtn = $this->Query($strStoredProc, $strParam);
			return $rtn;
		}

		public function &Collections_Gift_lst()
		{
			$strStoredProc = 'dsp_Collections_Gifts_lst';
			$strParam = '()' ;

          	$rtn = $this->Query($strStoredProc, $strParam);
			return $rtn;
		}

  		public function &Dailies_lst()
		{
			$strStoredProc = 'dsp_Dailies_lst';
			$strParam = '()' ;

          	$rtn = $this->Query($strStoredProc, $strParam);
			return $rtn;
		}

 		public function &Dailies_sel($DailyID)
		{
			$strStoredProc = 'dsp_Dailies_sel';
			$strParam = '('.$DailyID.')' ;

          	$rtn = $this->Query($strStoredProc, $strParam);
			return $rtn;
		}

  		public function &Decore_lst()
		{
			$strStoredProc = 'dsp_Decore_lst';
			$strParam = '()' ;

          	$rtn = $this->Query($strStoredProc, $strParam);
			return $rtn;
		}

		public function &Decore_sel($DecoreID)
		{
			$strStoredProc = 'dsp_Decore_sel';
			$strParam = '('.$DecoreID.')' ;

          	$rtn = $this->Query($strStoredProc, $strParam);
			return $rtn;
		}


  		public function &Level_Progression_lst()
		{
			$strStoredProc = 'dsp_Level_Progression_lst';
			$strParam = '()' ;

          	$rtn = $this->Query($strStoredProc, $strParam);
			return $rtn;
		}

		public function &Level_Progression_sel($level)
		{
			$strStoredProc = 'dsp_Level_Progression_sel';
			$strParam = '('.$level.')' ;

          	$rtn = $this->Query($strStoredProc, $strParam);
			return $rtn;
		}


  		public function &Missions_lst()
		{
			$strStoredProc = 'dsp_Missions_lst';
			$strParam = '()' ;

          	$rtn = $this->Query($strStoredProc, $strParam);
			return $rtn;
		}

   		public function &Quests_lst()
		{
			$strStoredProc = 'dsp_Quests_lst';
			$strParam = '()' ;

          	$rtn = $this->Query($strStoredProc, $strParam);
			return $rtn;
		}

   		public function &Quests_sel($questid)
		{
			$strStoredProc = 'dsp_Quests_sel';
			$strParam = '('.$questid.')' ;

          	$rtn = $this->Query($strStoredProc, $strParam);
			return $rtn;
		}

 		public function &Quest_Trigger_lst()
		{
			$strStoredProc = 'dsp_Quest_Triggers_lst';
			$strParam = '()' ;

          	$rtn = $this->Query($strStoredProc, $strParam);
			return $rtn;
		}

 		public function &Quest_Trigger_sel($type, $action)
		{
			$strStoredProc = 'dsp_Quest_Trigger_sel';
			$strParam = '('.$type.','.$action.')' ;

          	$rtn = $this->Query($strStoredProc, $strParam);
			return $rtn;
		}

   		public function &Quest_Steps_lst($questid)
		{
			$strStoredProc = 'dsp_Quest_Steps_lst';
			$strParam = '('.$questid.')' ;

          	$rtn = $this->Query($strStoredProc, $strParam);
			return $rtn;
		}

   		public function &Restrictions_lst()
		{
			$strStoredProc = 'dsp_Restrictions_lst';
			$strParam = '()' ;

          	$rtn = $this->Query($strStoredProc, $strParam);
			return $rtn;
		}

		public function &Restrictions_sel($resid)
		{
			$strStoredProc = 'dsp_Restrictions_sel';
			$strParam = '('.$resid.')' ;

          	$rtn = $this->Query($strStoredProc, $strParam);
			return $rtn;
		}

   		public function &Rewards_lst()
		{
			$strStoredProc = 'dsp_Rewards_lst';
			$strParam = '()' ;

          	$rtn = $this->Query($strStoredProc, $strParam);
			return $rtn;
		}

    	public function &Store_Buildings_lst()
		{
			$strStoredProc = 'dsp_Store_Buildings_lst';
			$strParam = '()' ;

          	$rtn = $this->Query($strStoredProc, $strParam);
			return $rtn;
		}

    	public function &Store_Decore_lst()
		{
			$strStoredProc = 'dsp_Store_Decore_lst';
			$strParam = '()' ;

          	$rtn = $this->Query($strStoredProc, $strParam);
			return $rtn;
		}

		public function &Store_sel($storeid)
		{
			$strStoredProc = 'dsp_Store_sel';
			$strParam = '('.$storeid.')' ;

          	$rtn = $this->Query($strStoredProc, $strParam);
			return $rtn;
		}


		public function Game_Init($source)
		{
			$strStoredProc = 'dsp_Game_init';
			$strParam = '('.$source.')' ;

			$rtn = $this->Query($strStoredProc, $strParam);
			return $rtn;
		}
 }

 ?>