<?php
/*
Description:    Product Purchase System
 
 ****************History************************************
 Date:         	1.12.2011
 Author:       	Allen Halsted
 Mod:          	Creation
 ***********************************************************
 */
include ($_SERVER['DOCUMENT_ROOT'] . '/gabriel.myaccount/lib/config/myaccount.config.inc.php');
include ($_SERVER['DOCUMENT_ROOT'] . '/gabriel.myaccount/lib/dal/dao_myaccount.class.php');
include ($_SERVER['DOCUMENT_ROOT'] . '/gabriel.common/misc/common.func.php');
include_once ($_SERVER['DOCUMENT_ROOT'] . '/gabriel.common/misc/system_start_session.inline.php');

class clsProducts {
	
	private $game_id;
	private $source_type;	
	private $purchase_system;
	private $user_id = '';
	private $objDAL;	

	function __construct($GameID, $SourceType, $System) {
		$this->game_id = $GameID;
		$this->source_type = $SourceType;
		$this->purchase_system = $System;
		$this->user_id = (isset($_SESSION['uriel_userid'])) ? $_SESSION['uriel_userid'] : '';
		$this->objDAL = new daoMyAccount(DB_ACC_HOST, DB_ACC_USER, DB_ACC_PASS, DB_ACCOUNT);
	}
	
	function __destruct() 
 	{
    	unset($this->objDAL);
   	}

	public function &GetProductList() {
		
		
		$result = $this->objDAL->Product_List($this->game_id);

		
        return $result;
    }
	
	public function &BeginTransaction($productid,$purchasecode) {
		
		
		$result = $this->objDAL->Product_Purchase($this->user_id, $this->game_id, $productid, $purchasecode, $this->purchase_system);
		
		$userproductid = $restul[0]->indx;
		//build payload to send to paypal		
		$payload = base64_url_encode($userproductid.'.'.$this->user_id.'.'.$this->game_id.'.'.$productid);
		//Payload Format Base64(userproductid.userid.gameid.productid)
		return $payload;
	
	}
    
	public function &CompletePurchase($itemcode,$externalid,$externaldata, $status) {
		//Will not have USER_ID here
		//Will not have GAME_ID here
		//Will not have SOURCE_TYPE here
		//Payload Format Base64(userproductid.userid.gameid.productid)
	
		//parse payload from paypal 
		$payload = explode(".", base64_url_decode($itemcode));
		//get userproductid, userid, gameid, productid from payload
		$userproductid = $payload[0];
		$userid = $payload[1];
		$gameid = $payload[2];
		$productid = $payload[3];
		
		//Verfiy purchase pending
 		$result = $this->objDAL>Product_Verify($userproductid, $userid, $gameid, $productid);
		if (isset($result))
		{
			//complete the purchase        	
			$result = $this->objDAL->Product_Complete($userproductid, $userid, $gameid, $productid, $externalid, $externaldata);
			//Apply the purchase
			$this->objDAL->Product_Apply($userid, $gameid, $productid);
		}else
		{
			//log the error
			$data = 'itemcode:'.$itemcode.'|payload:'.$payload.'|externalid:'.$externalid.'|externaldata:'.$externaldata;
			$this->objDAL->Error_Log($userid, $gameid, 'product_pruchase.CompletePurchase', 'Purchase Failed to verify', $data);
		}
					
			
    }
    

	public function &LogPurchaseErrors($ErrorMsg,$PayLoad) {

		$this->objDAL->Error_Log(0, 1, 'product_purchase', $ErrorMsg, $PayLoad);
    }
    
}
?>
