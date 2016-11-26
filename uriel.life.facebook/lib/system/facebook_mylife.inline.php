<?php
/*
Description:    show the main game play screen

****************History************************************
Date:         	1.17.2011
Author:       	Allen Halsted
Mod:          	Creation
***********************************************************
*/
include_once ($_SERVER['DOCUMENT_ROOT'] . '/uriel.life.facebook/lib/config/config.inc.php');
include_once ($_SERVER['DOCUMENT_ROOT'] . '/gabriel.life/lib/system/mem_static.class.php');
include_once ($_SERVER['DOCUMENT_ROOT'] . '/gabriel.life/lib/system/game_init.inline.php');

//default values
$dynamicvars = '';
$currentswf = '/uriel.life.common/public/swfs/mylife.swf';
$altswf = '/uriel.life.common/public/swfs/expressinstall.swf';

$app_id = APP_ID;
$api_key = API_KEY;
$canvas_base_url = CANVAS_BASE_URL;

//get from memcache
$mem_Static = objController::getStaticMEM();
$result = $mem_Static->GetGameInit(SOURCE_TYPE);
if(isset($result))
{
	$swf_url = $result->URL;

	$currentswf = $swf_url.$result->Main;
	$altswf = $swf_url.'expressinstall.swf';
	$dynamicvars = $dynamicvars.'header: "'.$result->Header.'",';
	$dynamicvars = $dynamicvars.'store: "'.$result->Store.'",';
	$dynamicvars = $dynamicvars.'friends: "'.$result->Friends.'",';
	$dynamicvars = $dynamicvars.'splash: "'.$result->Splash.'",';
	$dynamicvars = $dynamicvars.'swf: "'.$swf_url.'",';
}
unset($result);
unset($mem_Static);



if (isset($accesstoken))//set in /uriel.life.facebook/lib/system/facebook_init.inline.php
{
	$dynamicvars = $dynamicvars.'tokenid: "'.$accesstoken.'",';
}



//default setup not complete and not reviewed
$onlogin =  "$('#reward_button').hide();if(as.loggedin){install_panel.addPart();install_panel.fanCheck();install_panel.permissionsCheck();}";

if(isset($_SESSION['setup']))
{
	if(($_SESSION['setup']==1) || ($_SESSION['setup']==2))//not complete but reviewed
		$onlogin =  "$('#reward_button').hide();if(as.loggedin){install_panel.addPart();install_panel.fanCheck();install_panel.reviewCheck();install_panel.permissionsCheck();}";

	if($_SESSION['setup']==3)//setup complete and reviewed
		$onlogin = "$('.step_container').hide();$('.progress_container').hide();";
}
//deal with what to display on page load only 2 option right now
if(isset($acceptedRequest))
{//show the accepted request screen
	//message to player about accpeted gift
	$onlogin = $onlogin."as.hideAll();$('#accept_window').show();";

}else//show the play screen
	$onlogin = $onlogin."as.play();";


$tmplatename = 'facebook_mylife.tpl.php';
$tmplatefile = $_SERVER['DOCUMENT_ROOT'] . '/uriel.life.facebook/lib/templates/' . $tmplatename;


?>
