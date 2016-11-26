<?php
/*
Description:    Main web index page
                
****************History************************************
Date:         	1.11.2011
Author:       	Allen Halsted
Mod:          	Creation
***********************************************************
*/
  
//default settings
$myserver = $_SERVER['SERVER_NAME'];
  
  	
include ($_SERVER['DOCUMENT_ROOT'] . '/uriel.life.common/lib/config/tbs.inc.php');
$tpl = new clsTinyButStrong;
	  	
if (isset($_GET['login']))
{//Load Login Page
	include($_SERVER['DOCUMENT_ROOT'] . '/uriel.life.web/lib/system/show_login.php');
}elseif (isset($_GET['register']))
{//Load Register Page
	include($_SERVER['DOCUMENT_ROOT'] . '/uriel.life.web/lib/system/show_register.php');
}elseif (isset($_GET['mylife']))
{//Load Game Page
	include($_SERVER['DOCUMENT_ROOT'] . '/uriel.life.web/lib/system/show_mylife.php');
}if (isset($_GET['buy']))
{
	//Show the buy bookmarks screen
  	include($_SERVER['DOCUMENT_ROOT'] . '/uriel.life.common/lib/system/show_buybookmarks.php');
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
			break;
	}
  	
}else //Load Login Page
    include($_SERVER['DOCUMENT_ROOT'] . '/uriel.life.web/lib/system/show_login.php');
 	 	
//Load and display the template
$tpl->LoadTemplate($tmplatefile);
$tpl->Show();
 
 
?>