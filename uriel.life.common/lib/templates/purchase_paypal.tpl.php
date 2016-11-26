<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<title>Loading PayPal...</title>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
</head>
<body>
<form name="myform" action="[var.paypal_url]" method="post">
<input type="hidden" name="cmd" value="_xclick"> <input type="hidden"
	name="business" value="[var.paypal_merchantid]"> <input type="hidden"
	name="lc" value="US"> <input type="hidden" name="item_name"
	value="[var.item_descript]"> <input type="hidden" name="item_number"
	value="[var.payload]"> <input type="hidden" name="amount"
	value="[var.item_cost]"> <input type="hidden" name="currency_code"
	value="USD"> <input type="hidden" name="button_subtype"
	value="services"> <input type="hidden" name="no_note" value="1"> <input
	type="hidden" name="no_shipping" value="1"> <input type="hidden"
	name="undefined_quantity" value="0"> <input type="hidden" name="rm"
	value="1"> <input type="hidden" name="return" value="[var.return_url]">
<input type="hidden" name="cancel_return" value="[var.cancel_url]"> <input
	type="hidden" name="bn"
	value="PP-BuyNowBF:btn_buynowCC_LG.gif:NonHosted"> <input type="hidden"
	name="notify_url" value="[var.iplistner]">

</form>
<script type="text/javascript">
	document.myform.submit();
</script>
</body>
</html>

