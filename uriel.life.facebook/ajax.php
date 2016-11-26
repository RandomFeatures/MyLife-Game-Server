<?php
/*
Description:    Main facebook ajax page

****************History************************************
Date:         	2.16.2011
Author:       	Allen Halsted
Mod:          	Creation
***********************************************************
*/
include ($_SERVER['DOCUMENT_ROOT'] . '/uriel.life.common/lib/config/tbs.inc.php');
include_once ($_SERVER['DOCUMENT_ROOT'] . '/gabriel.common/misc/system_start_session.inline.php');
include_once ($_SERVER['DOCUMENT_ROOT'] . '/uriel.life.facebook/lib/config/config.inc.php');
include_once ($_SERVER['DOCUMENT_ROOT'].'/gabriel.life/lib/system/global_object_control.php');

//default settings
$myserver = $_SERVER['SERVER_NAME'];


if (isset($_GET['show_friend_request']))
{
	//load the facebook friends request FBML
	include($_SERVER['DOCUMENT_ROOT'] . '/uriel.life.facebook/lib/system/ajax_friend_request.php');

}elseif (isset($_GET['show_gift_request']))
{
	//load the facebook gift request FBML
	include($_SERVER['DOCUMENT_ROOT'] . '/uriel.life.facebook/lib/system/ajax_gift_request.php');

}elseif (isset($_GET['show_gift_select']))
{
	//load the gift selection html
	include($_SERVER['DOCUMENT_ROOT'] . '/uriel.life.facebook/lib/system/ajax_gift_selection.php');

}elseif (isset($_GET['show_reward_select']))
{
	//load the gift selection html
	include($_SERVER['DOCUMENT_ROOT'] . '/uriel.life.facebook/lib/system/ajax_reward_selection.php');

}elseif (isset($_GET['buy']))
{
	//Show the buy bookmarks screen
  	include($_SERVER['DOCUMENT_ROOT'] . '/uriel.life.common/lib/system/show_buybookmarks.php');

}elseif (isset($_GET['claim']))
{
	//claim my reward
  	include($_SERVER['DOCUMENT_ROOT'] . '/uriel.life.facebook/lib/system/ajax_reward_claim.php');
  	print ('Your reward has been added to your inventory!');//tell jquery we are done
  	//exit; continue through and nothing else should be called till cleanup
}elseif (isset($_GET['review']))
{
	//log that I reviewed the damn thing
  	include($_SERVER['DOCUMENT_ROOT'] . '/uriel.life.facebook/lib/system/ajax_reward_review.php');
  	print("true");//tell jQuery we are done
  	//exit; continue through and nothing else should be called till cleanup
}elseif (isset($_GET['purchasesystem']))
{
	/*
	T5wMy86: paypal
	D4ro243: facebook
	*/
	switch($_GET['purchasesystem'])
	{
		case 'T5wMy86'://paypal
			include($_SERVER['DOCUMENT_ROOT'] . '/uriel.life.common/lib/system/purchase_paypal.php');
			break;
		case 'D4ro243'://facebook
			//TODO facebook credits system
			break;
	}

}

if(isset($tmplatefile))
{
	$tpl = new clsTinyButStrong;
	//Load and display the template
	$tpl->LoadTemplate($tmplatefile);
	$tpl->Show();
	unset($tpl);
}



//Final Memory cleanup
objController::cleanUp();
?>
