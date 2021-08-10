<?php


ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);



function call_ipay_api() {
        $s2['ds2_email'] = 'client email';
        $s2['ds2_phone'] = 'client phone';
        $s2['ds2_contact'] = 'contact field';
        $s2['ds2_deliveryType'] = 'delivery type';
        $s2['ds2_shippingCountry'] = 'delivery country';
        $s2['ds2_shippingCity'] = 'delivery city';
        $s2['ds2_shippingPostAddress'] = 'full shipping address line1+line2+line3';
        if (strlen($s2['ds2_shippingPostAddress']) > 100) {
        $tmp_address = $s2['ds2_shippingPostAddress'];
        $s2['ds_shippingPostAddress']=substr($tmp_address,0,50);
        $s2['ds_shippingPostAddress2']=substr($tmp_address,50,50);
        $s2['ds_shippingPostAddress3']=substr($tmp_address,100,strlen($tmp_address));
        } else if (strlen($s2['ds2_shippingPostAddress']) > 50) {
        $tmp_address = $s2['ds2_shippingPostAddress'];
        $s2['ds_shippingPostAddress']=substr($tmp_address,0,50);
        $s2['ds_shippingPostAddress2']=substr($tmp_address,50,strlen($tmp_address));
    }
$s2['ds2_shippingState'] = 'delivery state if available empty string otherwise';
    if (strlen($s2['ds2_shippingState'])>3)
$s2['ds2_shippingState'] = '';
$s2['ds2_shippingPostCode'] = 'delivery postalcode if available empty string otherwise';
    if (strlen($s2['ds2_shippingPostCode'])>16)
$s2['ds2_shippingPostCode'] = '';
$s2['ds2_billingCountry'] = 'billing country';
$s2['ds2_billingCity'] = 'billing city';
$s2['ds2_billingPostAddress'] = 'full billing address line1+line2+line3';
if (strlen($s2['ds2_billingPostAddress']) > 100) {
$tmp_address = $s2['ds2_billingPostAddress'];
$s2['ds_billingPostAddress']=substr($tmp_address,0,50);
$s2['ds_billingPostAddress2']=substr($tmp_address,50,50);
$s2['ds_billingPostAddress3']=substr($tmp_address,100,strlen($tmp_address));
} else if (strlen($s2['ds2_billingPostAddress']) > 50) {
$tmp_address = $s2['ds2_billingPostAddress'];
$s2['ds_billingPostAddress']=substr($tmp_address,0,50);
$s2['ds_billingPostAddress2']=substr($tmp_address,50,strlen($tmp_address));
}
$s2['ds2_billingState'] = 'billing state if available empty string otherwise';
if (strlen($s2['ds2_billingState'])>3)
//Clasificare BT: Uz Intern
$s2['ds2_billingState'] = '';
$s2['ds2_billingPostCode'] = 'billing post code if available empty string otherwise';
if (strlen($s2['ds2_billingPostCode'])>16)
$s2['ds2_billingPostCode'] = '';
$orderBundle='{"orderCreationDate":"'.date("Y-m-d").'","customerDetails":{"email":"'.$s2['ds2_email'].'","phone":"40xxx xxx xxx"'.$s2['ds2_phone'].'","contact":"'.$s2['ds2_contact'].'","deliveryInfo":{"deliveryType":"'.$s2['ds2_deliveryType'].'","country":"'.$s2['ds2_shippingCountry'].'","city":"'.$s2['ds2_shippingCity'].'","postAddress":"'.$s2['ds2_shippingPostAddress'].'"';
if (isset($s2['ds_shippingPostAddress2']))
if ($s2['ds_shippingPostAddress2'])
$orderBundle.=',"postAddress2":"'.$s2['ds2_shippingPostAddress2'].'"';
if (isset($s2['ds_shippingPostaddress3']))
if ($s2['ds_shippingPostAddress3'])
$orderBundle.=',"postAddress3":"'.$s2['ds2_shippingPostAddress3'].'"';
if (isset($s2['ds_shippingPostCode']))
if ($s2['ds_shippingPostCode'])
$orderBundle.=',"postalCode":"'.$s2['ds2_shippingPostCode'].'"';
if (isset($s2['ds_shippingState']))
if ($s2['ds_shippingState'])
$orderBundle.=',"state":"'.$s2['ds2_shippingState'].'"';
$orderBundle.='},"billingInfo":{"country":"'.$s2['ds2_billingCountry'].'","city":"'.$s2['ds2_billingCity'].'","postAddress":"'.$s2['ds2_billingPostAddress'].'"';
if (isset($s2['ds_billingPostaddress2']))
if ($s2['ds_billingPostAddress2'])
$orderBundle.=',"postAddress2":"'.$s2['ds2_billingPostAddress2'].'"';
if (isset($s2['ds_billingPostaddress3']))
if ($s2['ds_billingPostAddress3'])
$orderBundle.=',"postAddress3":"'.$s2['ds2_billingPostAddress3'].'"';
if (isset($s2['ds_billingPostCode']))
if ($s2['ds_billingPostCode'])
$orderBundle.=',"postalCode":"'.$s2['ds2_billingPostCode'].'"';
if (isset($s2['ds_billingState']))
if ($s2['ds_billingState'])
$orderBundle.=',"state":"'.$s2['ds2_billingState'].'"';
$orderBundle.='}}}';
$jsp1 = '{"FORCE_3DS2":"true"}';
$orderBundle = str_replace("\n", "", $orderBundle);
$orderBundle = str_replace("\r", "", $orderBundle);

$order_data_a = array(
    "userName=".$username,
    "password=".$password,
    "orderNumber=".$order_number,
    "amount=".$amount,
    "currency=".$currency,
    "returnUrl=".$returnurl,
    "description=".$order_description,
    "installment=".$installment,
    "jsonParams=".$jsp1,
    "orderBundle=".$orderBundle
    );
$order_data = implode("&", $order_data_a);
$testsrvr = "";
if($testmode)
$testsrvr = ":5443";
//call API
if($tip_plata == 'one_phase') {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch,CURLOPT_URL,'https://ecclients.btrl.ro'.$testsrvr.'/payment/rest/register.do');
    curl_setopt($ch,CURLOPT_POSTFIELDS, $order_data);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        } else {
        $ch = curl_init();
        curl_setopt($ch,CURLOPT_URL,'https://ecclients.btrl.ro'.$testsrvr.'/payment/rest/registerPreAuth.do');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch,CURLOPT_POSTFIELDS, $order_data);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        }
//handle curl errors
if (!$order_result = curl_exec($ch)) {
$curl_url = curl_getinfo($ch,CURLINFO_EFFECTIVE_URL);
$curl_respcode = curl_getinfo($ch,CURLINFO_RESPONSE_CODE);
$curl_err = curl_error($ch);
error_log( sprintf( "curl error when accessing '%s' , HTTP code: '%s', error message '%s'", $curl_url,$curl_respcode, $curl_err ));
curl_close($ch);
return '';
}
curl_close($ch);
$result_ibtpay = json_decode($order_result);
//Clasificare BT: Uz Intern
$errCode = 0;
if(property_exists($result_ibtpay,'errorCode'))
$errCode = $result_ibtpay -> errorCode;
$errMsg = '';
if(property_exists($result_ibtpay,'errorMessage'))
$errMsg = $result_ibtpay -> errorMessage;
$ibtpay_url = '';
if(property_exists($result_ibtpay,'formUrl'))
$ibtpay_url = $result_ibtpay -> formUrl;
if($ibtpay_url) {
return $ibtpay_url;
} else
error_log( print_r('Error from iPay BT API:'.$errMsg,true) );
return '';
}




?>