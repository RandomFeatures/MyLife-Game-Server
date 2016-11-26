<?php
/*
 Description:    Basic purchase fuctions for paypal

 ****************History************************************
 Date:         	8.17.2010
 Author:       	Allen Halsted
 Mod:          	Creation
 ***********************************************************
 */
include ($_SERVER['DOCUMENT_ROOT'].'/gabriel.myaccount/lib/system/products.class.php');


if (isset($_SESSION['uriel_userid']) && isset($_POST['product'])) //Must be logged in or we are done here
{


	$paypal_url = 'https://www.paypal.com/cgi-bin/webscr';
	//Test Account
	//$paypal_merchantid = 'van_1280415240_biz@ale-games.com';
	//Live Account
	//$paypal_merchantid = 'D2Abooks@ale-games.com';
	//TODO get paypal account
	$paypal_merchantid = 'WJEBAMYMGR6ML';

	//TODO ditch all this and lookup the product
	$product = explode('|',$_POST['product']);

	$productID = $product[0];
	$item_descript =$product[1];
	$item_cost =$product[2];

	$objPurchase=new clsProducts(GAME_ID,SOURCE_TYPE,0);
	$payload = $objPurchase->BeginTransaction($productID);

	$return_url = BASE_URL;
	$cancel_url = BASE_URL;
	$iplistner = 'http://'.$_SERVER['SERVER_NAME'].'/gabriel.common/libs/paypal/ipnListener.php';


	//Load and display the template
	$tmplatename = 'purchase_paypal.tpl.php';
	$tmplatefile = $_SERVER['DOCUMENT_ROOT'] . '/uriel.life.common/lib/templates/' . $tmplatename;


}

?>
