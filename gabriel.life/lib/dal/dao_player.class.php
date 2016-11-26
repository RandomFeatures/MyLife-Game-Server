<?php
/*
 Description:    Data Access Object for Player

 ****************History************************************
 Date:         	1.18.2011
 Author:       	Allen Halsted
 Mod:          	Creation
 ***********************************************************
 */

include_once ($_SERVER['DOCUMENT_ROOT'].'/gabriel.common/libs/dal/dao_base.class.php');

 class daoPlayer extends daoBase
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


		/******Player Start******/
		public function Player_Start($UserID,$PlayerName,$XRef)
		{
			$strStoredProc = 'dsp_Player_Start';
			$strParam = '('.$UserID.',"'.$PlayerName.'","'.$XRef.'")' ;

			$this->Exec($strStoredProc, $strParam);
		}

		/******Player******/
 		public function &Player_Sel($userid)
		{
			$strStoredProc = 'dsp_Player_sel';
			$strParam = '('.$userid.')' ;

          	$rtn = $this->Query($strStoredProc, $strParam);
			return $rtn;

		}

 		public function Player_Upd($UserID,$PlayerName,$Level,$Experience,$Coins,$Bookmarks,$JobApproval,$Congregation,$Capacity,$Energy, $Setup, $MaxEnergy, $XRef)
		{
			$strStoredProc = 'dsp_Player_upd';
			$strParam = '('.$UserID.',"'.$PlayerName.'",'.$Level.','.$Experience.','.$Coins.','.$Bookmarks.','.$JobApproval.','.$Congregation.','.$Capacity.','.$Energy.','.$Setup.','.$MaxEnergy.',"'.$XRef.'")' ;

			$this->Exec($strStoredProc, $strParam);
		}

 		public function Player_Stats_Upd($UserID,$Level,$Experience,$Coins,$Bookmarks,$JobApproval,$Congregation,$Capacity, $Energy, $Setup, $MaxEnergy)
		{
			$strStoredProc = 'dsp_Player_Stats_upd';
			$strParam = '('.$UserID.','.$Experience.','.$Level.','.$Coins.','.$Bookmarks.','.$JobApproval.','.$Congregation.','.$Capacity.','.$Energy.','.$Setup.','.$MaxEnergy.')' ;

			$this->Exec($strStoredProc, $strParam);
		}

		/******Player Achievements******/
 		public function &Achievement_Lst($userid)
		{
			$strStoredProc = 'dsp_Player_Achievement_lst';
			$strParam = '('.$userid.')' ;

          	$rtn = $this->Query($strStoredProc, $strParam);
			return $rtn;

		}

 		public function &Achievement_Sel($pkid)
		{
			$strStoredProc = 'dsp_Player_Achievement_sel';
			$strParam = '('.$pkid.')' ;

          	$rtn = $this->Query($strStoredProc, $strParam);
			return $rtn;

		}

 		public function Achievement_Upd($id,$UserID,$AchievementID,$Count,$Level1,$Level2,$Level3,$Complete,$Active)
		{
			$strStoredProc = 'dsp_Player_Achievement_upd';
			$strParam = '('.$id.','.$UserID.','.$AchievementID.','.$Count.','.$Level1.','.$Level2.','.$Level3.','.$Complete.','.$Active.')' ;

			$this->Exec($strStoredProc, $strParam);
		}

 		public function Achievement_Del($pkid)
		{
			$strStoredProc = 'dsp_Player_Achievement_del';
			$strParam = '('.$pkid.')' ;

			$this->Exec($strStoredProc, $strParam);
		}

		/******Player Building Progress******/
 		public function &Building_Progress_Lst($userid)
		{
			$strStoredProc = 'dsp_Player_Building_Progress_lst';
			$strParam = '('.$userid.')' ;

          	$rtn = $this->Query($strStoredProc, $strParam);
			return $rtn;

		}

 		public function &Building_Progress_Sel($Userid, $ChurchID)
		{
			$strStoredProc = 'dsp_Player_Building_Progress_sel';
			$strParam = '('.$Userid.','.$ChurchID.')' ;

			return $this->Query($strStoredProc, $strParam);
		}

 		public function Building_Progress_Upd($UserID,$BuildingID,$ChurchID,$Item1,$Item1Done,$Item1Require,$Item1BuyNow,
 																				 $Item2,$Item2Done,$Item2Require,$Item2BuyNow,
 																				 $Item3,$Item3Done,$Item3Require,$Item3BuyNow,
 																				 $Item4,$Item4Done,$Item4Require,$Item4BuyNow,
 																				 $Item5,$Item5Done,$Item5Require,$Item5BuyNow,
 																				 $Item6,$Item6Done,$Item6Require,$Item6BuyNow,$Complete)
		{
			$strStoredProc = 'dsp_Player_Building_Progress_upd';
			$strParam = '('.$UserID.','.$BuildingID.','.$ChurchID.','.
									$Item1.','.$Item1Done.','.$Item1Require.','.$Item1BuyNow.','.
									$Item2.','.$Item2Done.','.$Item2Require.','.$Item2BuyNow.','.
									$Item3.','.$Item3Done.','.$Item3Require.','.$Item3BuyNow.','.
									$Item4.','.$Item4Done.','.$Item4Require.','.$Item4BuyNow.','.
									$Item5.','.$Item5Done.','.$Item5Require.','.$Item5BuyNow.','.
									$Item1.','.$Item6Done.','.$Item6Require.','.$Item6BuyNow.','.$Complete.')' ;

			$this->Exec($strStoredProc, $strParam);
		}

 		public function Building_Progress_Del($pkid)
		{
			$strStoredProc = 'dsp_Player_Building_Progress_del';
			$strParam = '('.$pkid.')' ;

			$this->Exec($strStoredProc, $strParam);
		}


		/******Player Building Recharge******/
 		public function &Building_Recharge_Lst($userid)
		{
			$strStoredProc = 'dsp_Player_Building_Recharge_lst';
			$strParam = '('.$userid.')' ;

          	$rtn = $this->Query($strStoredProc, $strParam);
			return $rtn;

		}

 		public function &Building_Recharge_Sel($UserID,$ChurchID)
		{
			$strStoredProc = 'dsp_Player_Building_Recharge_sel';
			$strParam = '('.$UserID.','.$ChurchID.')' ;

          	$rtn = $this->Query($strStoredProc, $strParam);
			return $rtn;

		}

 		public function Building_Recharge_Upd($UserID,$ChurchID,$BuildingID,$DailyID,$RechargeRate,$Complete)
		{
			$strStoredProc = 'dsp_Player_Building_Recharge_upd';
			$strParam = '('.$UserID.','.$ChurchID.','.$BuildingID.','.$DailyID.','.$RechargeRate.','.$Complete.')' ;

			$this->Exec($strStoredProc, $strParam);
		}

 		public function Building_Recharge_Del($pkid)
		{
			$strStoredProc = 'dsp_Player_Building_Recharge_del';
			$strParam = '('.$pkid.')' ;

			$this->Exec($strStoredProc, $strParam);
		}

		/******Player Church******/
 		public function &Church_Lst($userid)
		{
			$strStoredProc = 'dsp_Player_Church_lst';
			$strParam = '('.$userid.')' ;

          	$rtn = $this->Query($strStoredProc, $strParam);
			return $rtn;

		}

 		public function &Church_Buildings_Lst($userid)
		{
			$strStoredProc = 'dsp_Player_Church_Buildings_lst';
			$strParam = '('.$userid.')' ;

          	$rtn = $this->Query($strStoredProc, $strParam);
			return $rtn;

		}

 		public function &Church_Decore_Lst($userid)
		{
			$strStoredProc = 'dsp_Player_Church_Decore_lst';
			$strParam = '('.$userid.')' ;

          	$rtn = $this->Query($strStoredProc, $strParam);
			return $rtn;

		}

 		public function &Church_Sel($pkid, $UserID)
		{
			$strStoredProc = 'dsp_Player_Church_sel';
			$strParam = '('.$pkid.','.$UserID.')' ;

			return $this->Query($strStoredProc, $strParam);
		}

 		public function Church_Upd($id,$UserID,$ItemType,$ItemID,$GridX,$GridY,$SubGridX,$SubGridY,$FacingType,$Deleted)
		{
			$strStoredProc = 'dsp_Player_Church_upd';
			$strParam = '('.$id.','.$UserID.','.$ItemType.','.$ItemID.','.$GridX.','.$GridY.','.$SubGridX.','.$SubGridY.','.$FacingType.','.$Deleted.')' ;

			$this->Query($strStoredProc, $strParam);
		}

		public function &Church_Del($pkid,$UserID)
		{
			$strStoredProc = 'dsp_Player_Church_del';
			$strParam = '('.$pkid.','.$UserID.')' ;

          	$rtn = $this->Query($strStoredProc, $strParam);
			return $rtn;

		}



 		/******Player Collections******/
 		public function &Collections_Lst($userid)
		{
			$strStoredProc = 'dsp_Player_Collections_lst';
			$strParam = '('.$userid.')' ;

          	$rtn = $this->Query($strStoredProc, $strParam);
			return $rtn;

		}

 		public function &Collections_Sel($UserID, $CollectionID)
		{
			$strStoredProc = 'dsp_Player_Collections_sel';
			$strParam = '('.$UserID.','.$CollectionID.')' ;

          	$rtn = $this->Query($strStoredProc, $strParam);
			return $rtn;

		}

		public function &Collections_Item_Sel($UserID, $ItemID)
		{
			$strStoredProc = 'dsp_Player_Collection_Item_sel';
			$strParam = '('.$UserID.','.$ItemID.')' ;

          	$rtn = $this->Query($strStoredProc, $strParam);
			return $rtn;

		}


 		public function Collections_Upd($UserID,$CollectionID,$ItemID,$ItemCount)
		{
			$strStoredProc = 'dsp_Player_Collections_upd';

			$strParam = '('.$UserID.','.$CollectionID.','.$ItemID.','.$ItemCount.')' ;

			$this->Exec($strStoredProc, $strParam);
		}

 		public function Collections_Del($pkid)
		{
			$strStoredProc = 'dsp_Player_Collections_del';
			$strParam = '('.$pkid.')' ;

			$this->Exec($strStoredProc, $strParam);
		}

		/******Player Friends******/
 		public function &Friends_Lst($userid)
		{
			$strStoredProc = 'dsp_Player_Friends_lst';
			$strParam = '('.$userid.')' ;

          	$rtn = $this->Query($strStoredProc, $strParam);
			return $rtn;

		}

 		public function &Friends_Sel($UserID,$FriendID)
		{
			$strStoredProc = 'dsp_Player_Friends_sel';
			$strParam = '('.$UserID.','.$FriendID.')' ;

			return $this->Query($strStoredProc, $strParam);
		}

 		public function &Friends_Refresh($userid)
		{
			$strStoredProc = 'dsp_Player_Friends_Refresh';
			$strParam = '('.$userid.')' ;

          	$rtn = $this->Query($strStoredProc, $strParam);
			return $rtn;

		}

 		public function &Friends_Activate($pkid)
		{
			$strStoredProc = 'dsp_Player_Friends_Activate';
			$strParam = '('.$pkid.')' ;

          	$rtn = $this->Query($strStoredProc, $strParam);
			return $rtn;

		}


 		public function Friends_Upd($UserID,$FriendID,$XRef, $Active)
		{
			$strStoredProc = 'dsp_Player_Friends_upd';
			$strParam = '('.$UserID.','.$FriendID.',"'.$XRef.'",'.$Active.')' ;

			$this->Exec($strStoredProc, $strParam);
		}

 		public function Friends_Join($Accept,$Request)
		{
			$strStoredProc = 'dsp_Player_Friends_join';
			$strParam = '("'.$Accept.'","'.$Request.'")' ;

			$this->Exec($strStoredProc, $strParam);
		}

 		public function Friends_Used($UserID,$FriendID)
		{
			$strStoredProc = 'sp_Player_Friend_Used';
			$strParam = '('.$UserID.','.$FriendID.')' ;

			$this->Exec($strStoredProc, $strParam);
		}

 		public function Friends_Del($pkid)
		{
			$strStoredProc = 'dsp_Player_Friends_del';
			$strParam = '('.$pkid.')' ;

			$this->Exec($strStoredProc, $strParam);
		}



 		/******Player Inventory******/
 		public function &Inventory_Lst($userid)
		{
			$strStoredProc = 'dsp_Player_Inventory_lst';
			$strParam = '('.$userid.')' ;

          	$rtn = $this->Query($strStoredProc, $strParam);
			return $rtn;

		}

 		public function &Inventory_Sel($pkid)
		{
			$strStoredProc = 'dsp_Player_Inventory_sel';
			$strParam = '('.$pkid.')' ;

			return $this->Query($strStoredProc, $strParam);
		}

 		public function Inventory_Upd($UserID,$ItemID,$ItemType,$ItemCount)
		{
			$strStoredProc = 'dsp_Player_Inventory_upd';
			$strParam = '('.$UserID.','.$ItemID.','.$ItemType.','.$ItemCount.')' ;

			$this->Exec($strStoredProc, $strParam);
		}

 		public function Inventory_Del($pkid)
		{
			$strStoredProc = 'dsp_Player_Inventory_del';
			$strParam = '('.$pkid.')' ;

			$this->Exec($strStoredProc, $strParam);
		}

 		/******Player Quests******/
 		public function &Quests_Lst($userid)
		{
			$strStoredProc = 'dsp_Player_Quests_lst';
			$strParam = '('.$userid.')' ;

          	$rtn = $this->Query($strStoredProc, $strParam);
			return $rtn;

		}

 		public function &Quests_Sel($pkid)
		{
			$strStoredProc = 'dsp_Player_Quests_sel';
			$strParam = '('.$pkid.')' ;

			return $this->Query($strStoredProc, $strParam);
		}

 		public function Quests_Upd($id,$UserID,$QuestID,$Step1Require,$Step1Done,$Step2Require,$Step2Done,$Step3Require,$Step3Done,$Complete)
		{
			$strStoredProc = 'dsp_Player_Quests_upd';
			$strParam = '('.$id.','.$UserID.','.$QuestID.','.$Step1Require.','.$Step1Done.','.$Step2Require.','.$Step2Done.','.$Step3Require.','.$Step3Done.','.$Complete.')' ;

			$this->Exec($strStoredProc, $strParam);
		}

 		public function Quests_Del($pkid)
		{
			$strStoredProc = 'dsp_Player_Quests_del';
			$strParam = '('.$pkid.')' ;

			$this->Exec($strStoredProc, $strParam);
		}

 		/******Player Unlocks******/
 		public function &Unlocks_Lst($userid)
		{
			$strStoredProc = 'dsp_Player_Unlocks_lst';
			$strParam = '('.$userid.')' ;

          	$rtn = $this->Query($strStoredProc, $strParam);
			return $rtn;

		}

 		public function &Unlocks_Sel($pkid)
		{
			$strStoredProc = 'dsp_Player_Unlocks_sel';
			$strParam = '('.$pkid.')' ;

          	$rtn = $this->Query($strStoredProc, $strParam);
			return $rtn;

		}

 		public function Unlocks_Upd($id,$UserID,$UnlockType,$UnlockID)
		{
			$strStoredProc = 'dsp_Player_Unlocks_upd';
			$strParam = '('.$id.','.$UserID.','.$UnlockType.','.$UnlockID.')' ;

			$this->Exec($strStoredProc, $strParam);
		}

 		public function Unlocks_Del($pkid)
		{
			$strStoredProc = 'dsp_Player_Unlocks_del';
			$strParam = '('.$pkid.')' ;

			$this->Exec($strStoredProc, $strParam);
		}

 		/******Player Wishlist******/
 		public function &Wishlist_Lst($userid)
		{
			$strStoredProc = 'dsp_Player_Wishlist_lst';
			$strParam = '('.$userid.')' ;

          	$rtn = $this->Query($strStoredProc, $strParam);
			return $rtn;

		}

 		public function &Wishlist_Sel($pkid)
		{
			$strStoredProc = 'dsp_Player_Wishlist_sel';
			$strParam = '('.$pkid.')' ;

          	$rtn = $this->Query($strStoredProc, $strParam);
			return $rtn;

		}

 		public function Wishlist_Upd($UserID,$Item1,$Item2,$Item3,$Item4,$Item5)
		{
			$strStoredProc = 'dsp_Player_Wishlist_upd';
			$strParam = '('.$UserID.','.$Item1.','.$Item2.','.$Item3.','.$Item4.','.$Item5.')' ;

			$this->Exec($strStoredProc, $strParam);
		}

 		public function Wishlist_Del($pkid)
		{
			$strStoredProc = 'dsp_Player_Wishlist_del';
			$strParam = '('.$pkid.')' ;

			$this->Exec($strStoredProc, $strParam);
		}

 		/******Player Pending******/
 		public function &Pending_Lst($userid)
		{
			$strStoredProc = 'dsp_Player_Pending_lst';
			$strParam = '('.$userid.')' ;

          	$rtn = $this->Query($strStoredProc, $strParam);
			return $rtn;

		}

 		public function &Pending_Sel($UserID,$kvIDKey)
		{
			$strStoredProc = 'dsp_Player_Pending_sel';
			$strParam = '('.$UserID.',"'.$kvIDKey.'")' ;

          	$rtn = $this->Query($strStoredProc, $strParam);
			return $rtn;

		}

 		public function &Pending_Collect($UserID,$kvIDKey)
		{
			$strStoredProc = 'dsp_Player_Pending_Collect';
			$strParam = '('.$UserID.',"'.$kvIDKey.'")' ;

          	$rtn = $this->Query($strStoredProc, $strParam);
			return $rtn;

		}

		public function &Pending_Complete($UserID,$kvIDKey)
		{
			$strStoredProc = 'dsp_Player_Pending_Complete';
			$strParam = '('.$UserID.',"'.$kvIDKey.'")' ;

          	$rtn = $this->Query($strStoredProc, $strParam);
			return $rtn;

		}


 		public function Pending_Upd($UserID,$ItemType,$ItemID,$Source,$IDKey,$Complete)
		{
			$strStoredProc = 'dsp_Player_Pending_upd';
			$strParam = '('.$UserID.','.$ItemType.','.$ItemID.','.$Source.',"'.$IDKey.'",'.$Complete.')' ;

			$this->Exec($strStoredProc, $strParam);
		}

 		public function Pending_Del($UserID,$kvIDKey)
		{
			$strStoredProc = 'dsp_Player_Pending_del';
			$strParam = '('.$UserID.',"'.$kvIDKey.'")' ;

			$this->Exec($strStoredProc, $strParam);
		}

 		public function Request_Sent($UserID,$kvIDList)
		{
			$strStoredProc = 'dsp_Player_Requests_upd';
			$strParam = '('.$UserID.',"'.$kvIDList.'")' ;

			$this->Exec($strStoredProc, $strParam);
		}

 		public function &Request_List($UserID)
		{
			$strStoredProc = 'dsp_Player_Requests_sel';
			$strParam = '('.$UserID.')' ;

			$rtn = $this->Query($strStoredProc, $strParam);
			return $rtn;
		}



 }


 ?>