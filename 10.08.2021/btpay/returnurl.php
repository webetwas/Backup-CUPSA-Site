<?php
	include($_SERVER['DOCUMENT_ROOT'].'/config_db_mobile_pay/config_variables.php');
	$orderId = $_GET['orderId'];
	$testmode = FALSE;

        //Sandbox credentials
	//$username = "cupfocsani_api";
	//$password = "cupfocsani_api1";

	$username = "Cup_API";
	$password = "c11p54_Ap!";
    $data = array(
        "userName=".$username,
        "password=".$password,
        "orderId=".$orderId
    );
    if($testmode){
        $testsrvr = ":5443";
    }
    $order_data = implode("&", $data);
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_POST, true);
	curl_setopt($ch,CURLOPT_URL,'https://ecclients.btrl.ro'.$testsrvr.'/payment/rest/getOrderStatusExtended.do');
	curl_setopt($ch,CURLOPT_POSTFIELDS, $order_data);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    $order_result = curl_exec($ch);
	$order_result =  json_decode($order_result,TRUE);
	
	// Create connection
	$conn = new mysqli(SERVERNAME_CUPFOCSANI, USER_CUPFOCSANI, PASS_CUPFOCSANI, DB_CUPFOCSANI);
	// Check connection
	if ($conn->connect_error) {
	  die("Connection failed: " . $conn->connect_error);
	}
	$sql = "UPDATE bt_pay SET status = ".$order_result['orderStatus']." WHERE order_id= '".$order_result['attributes'][0]['value']. "' LIMIT 1";

	if ($conn->query($sql) === TRUE) {
	  //echo "New record created successfully";
	} else {
	  //echo "Error: " . $sql . "<br>" . $conn->error;
	}

	$conn->close();		
	/*
	echo "<pre>";
	print_r($order_result);
	echo "</pre>";
	*/
	$errorCode = $order_result['errorCode'];
	if($errorCode == 0){
		$actionCode = (int)$order_result['actionCode'];
		switch ($actionCode) {
			case 0:
				$errorMsg = "Plata a fost confirmata. <br>Va Multumim!";
				break;		
			case 320:
				$errorMsg =  "Eroare: Card inactiv. Vă rugăm activați cardul.";
				break;
			case 801:
				$errorMsg =  "Eroare: Emitent indisponibil.";
				break;
			case 803:
				$errorMsg =  "Eroare: Card blocat. Vă rugăm contactați banca emitentă.";
				break;
			case 805:
				$errorMsg =  "Eroare: Tranzacție respinsă.";
				break;
			case 861:
				$errorMsg =  "Eroare: Dată expirare card greșită.";
				break;
			case 871:
				$errorMsg =  "Eroare: CVV gresit.";
				break;
			case 905:
				$errorMsg =  "Eroare: Card invalid. Acesta nu există în baza de date.";
				break;
			case 906:
				$errorMsg =  "Eroare: Card expirat.";
				break;
			case 914:
				$errorMsg =  "Eroare: Cont invalid. Vă rugăm contactați banca emitentă.";
				break;
			case 915:
				$errorMsg =  "Eroare: Fonduri insuficiente.";
				break;
			case 917:
				$errorMsg =  "Eroare: Limită tranzacționare depășită.";
				break;
			case 998:
				$errorMsg =  "Eroare: Tranzacția în rate nu este permisă cu acest card. Te rugăm să folosești un card de credit emise de Banca Transilvania.";
				break;	
			case 341016:
				$errorMsg =  "Tranzacție respinsă. Cod eroare: ".$actionCode;
				break;
			case 341017:
				$errorMsg =  "Tranzacție respinsă. Cod eroare: ".$actionCode;
				break;
			case 341018:
				$errorMsg =  "Tranzacție respinsă. Cod eroare: ".$actionCode;
				break;
			case 341019:
				$errorMsg =  "Tranzacție respinsă. Cod eroare: ".$actionCode;
				break;
			case 341020:
				$errorMsg =  "Tranzacție respinsă. Cod eroare: ".$actionCode;
				break;		
			default:
				$errorMsg =  "Tranzacție refuzată, vă rugăm reveniți.";
		}
	}
	else if($errorCode == 5){
		$errorMsg = "Eroare la procesarea tranzacției";
	}
	else if($errorCode == 6){
		$errorMsg = "orderId neînregistrat";
	}
	else if($errorCode == 7){
		$errorMsg = "Eroare de sistem";
	}	
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
	<title>Compania de Utilitati Publice - Plata online cu cardul</title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta http-equiv="author" content="BT" />
	<meta http-equiv="copyright" content="(c)BT" />
	<meta http-equiv="rating" content="general" />
	<meta http-equiv="distribution" content="general" />

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
	<link rel="stylesheet" href="css/style.css" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!-- <link href="<?php //echo "http://" . $_SERVER['SERVER_NAME']?>/public/assets/css/jquery.realperson.css" rel="stylesheet">  -->
	<!--este necesar acest realperson.css????--> 
	
</head>
<style>
center{
	margin-top:2%;
	max-width: 1000px;
    margin-left: auto;
    margin-right: auto;
}
</style>
<body>
	<?php if(isset($orderId)){ ?>	
		<center>
			<div><img src="../mobilpay/openimage/large-logo.jpg" alt=""></div>
			<h4 style="margin-top: 30px;" class="<?= $errorCode == 0 && $actionCode == 0 ? 'alert alert-success' : 'alert alert-danger'?>"><?php echo $errorMsg;?></h3>


			<?php if($errorCode == 0 && $actionCode != 0){ ?>
				<br>
				<div><a href="http://cupfocsani.ro/btpay" class="btn btn-outline-info"><i class="fas fa-undo"></i> Reincearca</a>  </div>
			<?php } ?>
			<?php if($errorCode == 0 && $actionCode == 0){ ?>
				<div class="col-lg-12 text-center m-t">
					<div class="text-center">
						<a href="http://cupfocsani.ro" class="btn btn-outline-info"><i class="fas fa-arrow-left"></i> Inapoi in site </a>
					</div>
				</div>
			<?php } ?>		

		</center>
	<?php } else { ?>	
		<center>
			Niciun raspuns
		</center>
	<?php }  ?>	
</body>
</html>
		