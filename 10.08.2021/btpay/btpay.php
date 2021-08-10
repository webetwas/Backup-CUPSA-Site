<?php 

include($_SERVER['DOCUMENT_ROOT'].'/config_db_mobile_pay/config_variables.php');

/*
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
*/
function call_ipay_api() {
	//define API variables
	$testmode = FALSE;
	$tip_plata = 'one_phase';
        //Sandbox credentials
	//$username = "cupfocsani_api";
	//$password = "cupfocsani_api1";

	$username = "Cup_API";
	$password = "c11p54_Ap!";
	
	
	$amount = $_POST['amount']*100;
	$currency = 946;
	$returnurl = "http://cupfocsani.ro/btpay/returnurl.php";
	$order_number = $_POST['codclient']."-".substr(md5(time()), 0, 10);
	$order_description = "Plata factura client CUP: ".$_POST['codclient'];

    $s2['ds2_email'] = $_POST['billing_email'];
    $s2['ds2_phone'] = '407400000';
    $s2['ds2_contact'] = '-';
    $s2['ds2_deliveryType'] = 'comanda';
    $s2['ds2_shippingCountry'] = 642;
    $s2['ds2_shippingCity'] = '-';

    $s2['ds2_shippingPostAddress'] = '-';
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

    $s2['ds2_shippingState'] = '-';
    if (strlen($s2['ds2_shippingState'])>3)
        $s2['ds2_shippingState'] = '';

    $s2['ds2_shippingPostCode'] = '-';
    if (strlen($s2['ds2_shippingPostCode'])>16)
        $s2['ds2_shippingPostCode'] = '';

    $s2['ds2_billingCountry'] = 642;
    $s2['ds2_billingCity'] = '-';
    $s2['ds2_billingPostAddress'] = '-';

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

    $s2['ds2_billingState'] = '-';
    if (strlen($s2['ds2_billingState'])>3)
        $s2['ds2_billingState'] = '';

    $s2['ds2_billingPostCode'] = '-';
    if (strlen($s2['ds2_billingPostCode'])>16)
        $s2['ds2_billingPostCode'] = '';

    $orderBundle='{"orderCreationDate":"'.date("Y-m-d").'","customerDetails":{"email":"'.$s2['ds2_email'].'","phone":"'.$s2['ds2_phone'].'","contact":"'.$s2['ds2_contact'].'","deliveryInfo":{"deliveryType":"'.$s2['ds2_deliveryType'].'","country":"'.$s2['ds2_shippingCountry'].'","city":"'.$s2['ds2_shippingCity'].'","postAddress":"'.$s2['ds2_shippingPostAddress'].'"';
   
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
	
	/*
	echo '<pre>';
	print_r($result_ibtpay);
	echo '</pre>';
	die();
	*/
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
		//inserare tranzactie in baza de date
		// Create connection
		$conn = new mysqli(SERVERNAME_CUPFOCSANI, USER_CUPFOCSANI, PASS_CUPFOCSANI, DB_CUPFOCSANI);
		// Check connection
		if ($conn->connect_error) {
		  die("Connection failed: " . $conn->connect_error);
		}
		$postCodClient = $_POST['codclient'];
		$postSuma = $_POST['amount'];
		$ibtpayOrderId = $result_ibtpay->orderId;
		$dataCreare = date('Y/m/d H:i:s');
		$mod_productie = 1;
		if($testmode == TRUE){
			$mod_productie = 0;
		}
		$sql = "INSERT INTO bt_pay (order_id, cod_client, suma, status, data_creare, mod_productie)
		VALUES ('$ibtpayOrderId',$postCodClient,$postSuma, 0, '$dataCreare',$mod_productie)";

		if ($conn->query($sql) === TRUE) {
		  //echo "New record created successfully";
		} else {
		  //echo "Error: " . $sql . "<br>" . $conn->error;
		}

		$conn->close();		
        return $ibtpay_url;
    } else
        error_log( print_r('Error from iPay BT API:'.$errMsg,true) );
    return '';
}


$ibtpay_url = call_ipay_api();



	

?>

<?php
/*
	ini_set('display_errors', '1');
	ini_set('display_startup_errors', '1');
	error_reporting(E_ALL);

    $s2['ds2_email'] = $_POST['billing_email'];
    $s2['ds2_phone'] = '-';
    $s2['ds2_contact'] = '-';
    $s2['ds2_deliveryType'] = 'comanda';
    $s2['ds2_shippingCountry'] = '642';
    $s2['ds2_shippingCity'] = 'Focsani';

    $s2['ds2_shippingPostAddress'] = '-';
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

    $s2['ds2_shippingState'] = '-';
    if (strlen($s2['ds2_shippingState'])>3)
        $s2['ds2_shippingState'] = '';

    $s2['ds2_shippingPostCode'] = '-';
    if (strlen($s2['ds2_shippingPostCode'])>16)
        $s2['ds2_shippingPostCode'] = '';

    $s2['ds2_billingCountry'] = '642';
    $s2['ds2_billingCity'] = '-';
    $s2['ds2_billingPostAddress'] = '-';

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

    $s2['ds2_billingState'] = '-';
    if (strlen($s2['ds2_billingState'])>3)
        $s2['ds2_billingState'] = '';

    $s2['ds2_billingPostCode'] = '-';
    if (strlen($s2['ds2_billingPostCode'])>16)
        $s2['ds2_billingPostCode'] = '';

    $orderBundle='{"orderCreationDate":"'.date("Y-m-d").'","customerDetails":{"email":"'.$s2['ds2_email'].'","phone":"'.$s2['ds2_phone'].'","contact":"'.$s2['ds2_contact'].'","deliveryInfo":{"deliveryType":"'.$s2['ds2_deliveryType'].'","country":"'.$s2['ds2_shippingCountry'].'","city":"'.$s2['ds2_shippingCity'].'","postAddress":"'.$s2['ds2_shippingPostAddress'].'"';
   
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

	$username = "cupfocsani_api";
	$password = "cupfocsani_api1";

    $jsp1 = '{"FORCE_3DS2":"true"}';
	
	$amount = $_POST['amount']*100;
	$orderNumber = $_POST['codclient']."-".substr(md5(time()), 0, 10);
	$order_description = "Plata factura client CUP: ".$_POST['codclient'];
	
	$orderBundle = str_replace("\n", "", $orderBundle);
    $orderBundle = str_replace("\r", "", $orderBundle);	
    $order_data_a = array(
        "userName=".$username,
        "password=".$password,
        "orderNumber=".$orderNumber,
        "amount=".$amount,
        "currency=946",
        "returnUrl=http://cupfocsani.ro/btpay/returnurl.php",
		"description=".$order_description,
        "jsonParams=".$jsp1,
		"orderBundle=".$orderBundle
    );

    $order_data = implode("&", $order_data_a);
    //call API
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_POST, true);
	curl_setopt($ch,CURLOPT_URL,'https://ecclients.btrl.ro:5443/payment/rest/register.do');
	curl_setopt($ch,CURLOPT_POSTFIELDS, $order_data);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    $order_result = curl_exec($ch);
	$order_result =  json_decode($order_result,TRUE);
	//print_r($order_result);
	if(isset($order_result['formUrl'])){
		//header('Location: '.$order_result['formUrl']);
		$redirecUrl = $order_result['formUrl'];
	}
*/
?>
<!DOCTYPE html>
<html>
<head>
<title>Va rugam asteptati. Veti fi redirectionat catre pagina de plata</title>
<style>
.loading_icon{
    text-align: center;
    margin-top: 10%;
}
</style>
</head>
<body>

<div class="loading_icon">
	<img src= "loading.gif">
</div>
<script>
	<?php if(isset($ibtpay_url) && !empty($ibtpay_url)){?>
		window.location.href = "<?php echo $ibtpay_url; ?>";
	<?php } ?>

</script>
</body>



