<?php
	
include ($_SERVER['DOCUMENT_ROOT'].'/gabriel.myaccount/lib/system/products.class.php');

$tmplatename = 'buy_bookmarks.tpl.php';
$tmplatefile = $_SERVER['DOCUMENT_ROOT'] . '/uriel.life.common/lib/templates/' . $tmplatename;

//webservice object
$objPurchase=new clsProducts(GAME_ID,SOURCE_TYPE,0);
//get list of products into a PHP recordset
$result = $objPurchase->GetProductList();
$productleft = '';
$productright = '';
$icount = 0;
$select = "checked"; 
$purchasesystem = 'T5wMy86';//paypal

$split = (count($result)/2);
reset($result);
foreach ($result as $row)
{ //grab each row from the record set and display the results
	
	$productID = $row->ProductID;
    $productName = $row->ProductName;
    $price = $row->Price;
    $radID = $productName.$productID;
    $radValue = $productID.'|'.$productName.' Bookmarks|'.$price;
    if($icount < $split)
    {
    $productleft = $productleft.'<tr>
									<td>
										<input class="" id="'.$radID.'" name="product" type="radio" value="'.$radValue.'" '.$select.'/>
									</td>
									<td class="currency">
										<label for="'.$radID.'">'.$productName.'</label>
									</td>
									<td>
										<div class="bookmarks" />
									</td>
									<td class="price">
										<label for="'.$radID.'">
											<span class="total_price">$'.$price.'.00</span>
											<span class="currency_code">USD</span>
									  	</label>
									</td>
									<td class="discount">
									  	<label for="'.$radID.'">&nbsp;</label>
									</td>
								</tr>' ; 
    }else
    {
    	 $productright = $productright.'<tr>
									<td>
										<input class="" id="'.$radID.'" name="product" type="radio" value="'.$radValue.'" '.$select.'/>
									</td>
									<td class="currency">
										<label for="'.$radID.'">'.$productName.'</label>
									</td>
									<td>
										<div class="bookmarks" />
									</td>
									<td class="price">
										<label for="'.$radID.'">
											<span class="total_price">$'.$price.'.00</span>
											<span class="currency_code">USD</span>
									  	</label>
									</td>
									<td class="discount">
									  	<label for="'.$radID.'">&nbsp;</label>
									</td>
								</tr>' ; 
    }
    $select = "unchecked"; 
    $icount++;
}
   
//clean up	
unset($row);
unset($objPurchase);	
unset($_results);

?>