<?php
/*
 Description:    Auto create one instance of the player dao

 ****************History************************************
 Date:         	2.21.2011
 Author:       	Allen Halsted
 Mod:          	Creation
 ***********************************************************
 */

include_once ($_SERVER['DOCUMENT_ROOT'].'/gabriel.life/lib/config/player.config.inc.php');
include_once ($_SERVER['DOCUMENT_ROOT'].'/gabriel.life/lib/dal/dao_player.class.php');
include_once ($_SERVER['DOCUMENT_ROOT'].'/gabriel.life/lib/system/player_stats.class.php');
include_once ($_SERVER['DOCUMENT_ROOT'].'/gabriel.life/lib/system/mem_static.class.php');


class objController
{
	private static $objDAL_Player;
	private static $objMEM_Static;

	public static function cleanUp()
	{
		if(isset(self::$objDAL_Player))
			unset(self::$objDAL_Player);

		if(isset(self::$objMEM_Static))
			unset(self::$objMEM_Static);

	}

	public static function &getPlayerDAL()
	{
		if(!isset(self::$objDAL_Player))
			self::$objDAL_Player = new daoPlayer(DB_HOST, DB_USER, DB_PASS, DB_PLAYER);

		return self::$objDAL_Player;
	}

	public static function &getStaticMEM()
	{
		if(!isset(self::$objMEM_Static))
			self::$objMEM_Static = new clsStaticMem();

		return self::$objMEM_Static;
	}

}


?>