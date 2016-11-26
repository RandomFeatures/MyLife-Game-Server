<?php
/*
 Description:   Game Get/Set game system specific
 				data in memcache and the database
 Purpose:		Current swf file
 				assets location
 			
 ****************History************************************
 Date:         	1.19.2011
 Author:       	Allen Halsted
 Mod:          	Creation
 ***********************************************************
 */
include ($_SERVER['DOCUMENT_ROOT'].'/gabriel.life/lib/config/game.config.inc.php');
include ($_SERVER['DOCUMENT_ROOT'].'/gabriel.life/lib/dal/dao_game.class.php');
include_once ($_SERVER['DOCUMENT_ROOT'].'/gabriel.common/misc/system_start_session.inline.php');

class clsGame {
    
	
	private $game_id;
	private $source_type;	
	private $objDAL;
	private $user_id;
	private $objGamePlay;
	
	function __construct($GameID, $SourceType) {
		$this->game_id = $GameID;
		$this->source_type = $SourceType;
		$this->user_id = (isset($_SESSION['uriel_userid'])) ? $_SESSION['uriel_userid'] : '';
		$this->objDAL = new daoGame(DB_HOST, DB_USER, DB_PASS, DB_PLAYER);
		
	}

	
}


?>
	