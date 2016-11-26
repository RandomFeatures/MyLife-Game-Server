<?php
/*
 Description:    Destroy the session and start a new one

 ****************History************************************
 Date:         	1.12.2011
 Author:       	Allen Halsted
 Mod:          	Creation
 ***********************************************************
 */

/* Destroy any existing session */

if(isset($_SESSION))
{
	session_destroy();
	unset($_SESSION);
}

?>
