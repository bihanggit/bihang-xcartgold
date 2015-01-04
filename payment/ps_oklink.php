<?php
 
require './auth.php';	
require $xcart_dir.'/modules/Oklink/oklink.php';

$module_params = func_get_pm_params('ps_oklink.php');
$api_key = $module_params['param01'];
$api_secret = $module_params['param02'];
$client = Oklink::withApiKey($api_key,$api_secret);

if ($client->checkCallback()) {

	$oklink_order = json_decode(file_get_contents('php://input'));
	// fetch session
	$skey = $orderids = $oklink_order->custom;
	$bill_output['sessid'] = func_query_first_cell("SELECT sessid FROM $sql_tbl[cc_pp3_data] WHERE ref='".$orderids."'");

	// APC system responder
	foreach ($_POST as $k => $v) {
		$advinfo[] = "$k: $v";
	}
		
	// update order status
	if ($oklink_order->status == 'completed')
	{
		$bill_output['sessid'] = func_query_first_cell("SELECT sessid FROM $sql_tbl[cc_pp3_data] WHERE ref='".$orderids."'");
			
		$bill_output['code'] = 1;			
		$bill_output['billmsg'] = 'Order paid for';

		require($xcart_dir.'/payment/payment_ccend.php');
		
	}
} 
else { // POST from customer placing the order

    if (!defined('XCART_START')) { header("Location: ../"); die("Access denied"); }	
	
	// associate order id with session
	$_orderids = join("-",$secure_oid);

    if (!$duplicate)
        db_query("REPLACE INTO $sql_tbl[cc_pp3_data] (ref,sessid,trstat) VALUES ('".$_orderids."','".$XCARTSESSID."','GO|".implode('|',$secure_oid)."')");
	
	$params = array(
		'name'           => 'Order #'.$_orderids,
		'price'          => $cart['total_cost'],    
		'price_currency' => $module_params['param03'],
		'callback_url' => $current_location.'/payment/ps_oklink.php',
		'success_url'  => $current_location.'/order.php?orderid='.$_orderids,
		);
	try{
		$response = $client->buttonsButton($params);
	}catch(Exception $e){
		error_log($e->message);
	}	
	
	
	if ( $response && $response->button)
	{
		$url = OklinkBase::WEB_BASE.'merchant/mPayOrderStemp1.do?buttonid='.$response->button->id;
		print "<script> window.location = '$url'; </script>"; 
		exit;
	}
}
