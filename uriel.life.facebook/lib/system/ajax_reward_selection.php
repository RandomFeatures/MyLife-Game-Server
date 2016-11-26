<?php
/*
Description:    show reward selection form

****************History************************************
Date:         	2.14.2011
Author:       	Allen Halsted
Mod:          	Creation
***********************************************************
*/
include_once ($_SERVER['DOCUMENT_ROOT'].'/gabriel.common/misc/system_start_session.inline.php');
include ($_SERVER['DOCUMENT_ROOT'].'/gabriel.life/lib/system/player_stats.class.php');

//get a list of all available gifts
if(isset($_SESSION['uriel_userid']))
{
	$stats = new clsPlayerStats();

	if($stats->getSetup()==2)//have reviewed ready to look
	{
		//$stats->addSetup();//setup is complete and I and looking for a reward


		$user_id = $_SESSION['uriel_userid'];
		$mem_Static = objController::getStaticMEM();


		$level = $stats->getLevel();
		$rewards='<ul class="column">';


		if($result = $mem_Static->GetStoreDecore())
		{
			reset($result);
			foreach ($result as $row)
			{

				if($row->Level<=($level+10))
				{
					//normal available gifts
					$rewards = $rewards.'<li><div class="block">';
					$rewards = $rewards.'		<img class="shadow" src="http://'.$_SERVER['SERVER_NAME'].'/uriel.life.common/public/images/rewards/'.$row->StoreIcon.'" />';
					$rewards = $rewards.'		<div style="padding:5px;text-align:center">';
					$rewards = $rewards.$row->Dscrpt;
					$rewards = $rewards.'		</div>';
					$rewards = $rewards.'		<div style="padding:5px;">';
					$rewards = $rewards.'			<input class="center" type="radio" name="gift" value="'.$row->ItemType.$row->ItemID.'" />';
					$rewards = $rewards.'		</div>';
					$rewards = $rewards.'	</div>';
					$rewards = $rewards.'</li>';
				}

			}

			unset($result);
			unset($row);
		}

		if($result = $mem_Static->GetGiftList())
		{
			reset($result);
			foreach ($result as $row)
			{

				if($row->Level<=($level+10))
				{
					//normal available gifts
					$rewards = $rewards.'<li><div class="block">';
					$rewards = $rewards.'		<img class="shadow" src="http://'.$_SERVER['SERVER_NAME'].'/uriel.life.common/public/images/gifts/'.$row->Image.'" />';
					$rewards = $rewards.'		<div style="padding:5px;text-align:center">';
					$rewards = $rewards.$row->Name;
					$rewards = $rewards.'		</div>';
					$rewards = $rewards.'		<div style="padding:5px;">';
					$rewards = $rewards.'			<input class="center" type="radio" name="gift" value="2'.$row->id.'" />';
					$rewards = $rewards.'		</div>';
					$rewards = $rewards.'	</div>';
					$rewards = $rewards.'</li>';
				}

			}

			$rewards.'</ul>';
			unset($result);
			unset($row);
		}

	}
	unset($stats);
}


/*
<ul class="column">
   <!--Repeating list item-->
   <li>
       <div class="block">
       <!--Content-->
       </div>
   </li>
   <!--end repeating list item-->
</ul>
 */


$tmplatename = 'div_reward_selection.tpl.php';
$tmplatefile = $_SERVER['DOCUMENT_ROOT'] . '/uriel.life.facebook/lib/templates/' . $tmplatename;



?>