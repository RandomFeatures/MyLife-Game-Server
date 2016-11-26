<?php
 /*
Description:    Show the registeration form
                
****************History************************************
Date:         	10.11.2009
Author:       	Allen Halsted
Mod:          	Creation
***********************************************************
*/    

include ($_SERVER['DOCUMENT_ROOT'].'/gabriel.common/misc/system_start_session.inline.php');

$tmplatename='web_register.tpl.php';
$tmplatefile = $_SERVER['DOCUMENT_ROOT'] . '/uriel.life.web/lib/templates/' . $tmplatename;
//pick a random starting point
$start = rand(0,7);
//pick a random key item after the current start
$rand = rand($start,$start+4);
//double the list to create the appearance of random ness
$itemlist = Array("pencil", "scissors", "clock", "heart", "note", "book", "pencil", "scissors", "clock", "heart", "note", "book");
//get the name of the key item
$item = $itemlist[$rand];
//record the base for the key so it can be checked
$_SESSION[captcha] = $rand - $start;

?>
