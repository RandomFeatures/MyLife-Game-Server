<?php

/*
 Description:    Wrapper for CURL HTTPS Post

 ****************History************************************
 Date:         	8.16.2010
 Author:       	Allen Halsted
 Mod:          	Creation
 ***********************************************************
 */


function httpsPost($Url, $strRequest)
{
	// Initialisation
	$ch=curl_init();
	// Set parameters
	curl_setopt($ch, CURLOPT_URL, $Url);
	// Return a variable instead of posting it directly
	//curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	// Active the POST method
	curl_setopt($ch, CURLOPT_POST, 1) ;
	// Request
	curl_setopt($ch, CURLOPT_POSTFIELDS, $strRequest);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
	// execute the connexion
	$result = curl_exec($ch);
	// Close it
	curl_close($ch);
	return $result;
}

?>