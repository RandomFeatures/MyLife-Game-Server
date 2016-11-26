<?php
/*
Description:    show gift selection form

****************History************************************
Date:         	1.17.2011
Author:       	Allen Halsted
Mod:          	Creation
***********************************************************
*/
include_once ($_SERVER['DOCUMENT_ROOT'].'/gabriel.common/misc/system_start_session.inline.php');
include ($_SERVER['DOCUMENT_ROOT'].'/gabriel.life/lib/system/player_stats.class.php');



//get a list of all available gifts
if(isset($_SESSION['uriel_userid']))
{
	$user_id = $_SESSION['uriel_userid'];
	$mem_Static = objController::getStaticMEM();
	$stats = new clsPlayerStats();
	$select = "checked";
	$level = $stats->getLevel();
	$gifts='<ul class="column">';


	$result = $mem_Static->GetGiftList();
	reset($result);
	foreach ($result as $row)
	{

		if($row->Level<= $level)
		{
			//normal available gifts
			$gifts = $gifts.'<li><div class="block">';
			$gifts = $gifts.'		<img class="shadow" src="http://'.$_SERVER['SERVER_NAME'].'/uriel.life.common/public/images/gifts/'.$row->Image.'" />';
			$gifts = $gifts.'		<div style="padding:5px;text-align:center">';
			$gifts = $gifts.$row->Name;
			$gifts = $gifts.'		</div>';
			$gifts = $gifts.'		<div style="padding:5px;">';
			$gifts = $gifts.'			<input class="center" type="radio" name="gift" value="'.$row->id.'" '.$select.' />';
			$gifts = $gifts.'		</div>';
			$gifts = $gifts.'	</div>';
			$gifts = $gifts.'</li>';
			$select = "unchecked";
		}else {
			//locked gifts
			$gifts = $gifts.'<li><div class="block" style="background:#D8D8D8;border: 1px solid #A4A4A4; border-bottom: 2px solid #585858;">';
			$gifts = $gifts.'		<img class="shadow" src="http://'.$_SERVER['SERVER_NAME'].'/uriel.life.common/public/images/gifts/'.$row->Image.'" />';
			$gifts = $gifts.'		<div style="padding:5px;text-align:center;color:#A4A4A4">';
			$gifts = $gifts.$row->Name;
			$gifts = $gifts.'		</div>';
			$gifts = $gifts.'		<div style="padding:5px;text-align:center;font-size:.8em;color:#FF0000">';
			$gifts = $gifts.'Level: '.$row->Level;
			$gifts = $gifts.'		</div>';
			$gifts = $gifts.'	</div>';
			$gifts = $gifts.'</li>';
		}

	}

	$gifts.'</ul>';
	unset($result);
	unset($row);
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


$tmplatename = 'div_gift_selection.tpl.php';
$tmplatefile = $_SERVER['DOCUMENT_ROOT'] . '/uriel.life.facebook/lib/templates/' . $tmplatename;



?>