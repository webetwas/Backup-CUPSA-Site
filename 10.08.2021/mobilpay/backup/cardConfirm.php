<?php
require_once 'Mobilpay/Payment/Request/Abstract.php';
require_once 'Mobilpay/Payment/Request/Card.php';
require_once 'Mobilpay/Payment/Request/Notify.php';
require_once 'Mobilpay/Payment/Invoice.php';
require_once 'Mobilpay/Payment/Address.php';

$errorCode 		= 0;
$errorType		= Mobilpay_Payment_Request_Abstract::CONFIRM_ERROR_TYPE_NONE;
$errorMessage	= '';

if (strcasecmp($_SERVER['REQUEST_METHOD'], 'post') == 0)
{
	if(isset($_POST['env_key']) && isset($_POST['data']))
	{
		#calea catre cheia privata
		#cheia privata este generata de mobilpay, accesibil in Admin -> Conturi de comerciant -> Detalii -> Setari securitate

		// $privateKeyFilePath = 'i.e: /home/certificates/private.key';

		$privateKeyFilePath = '/home/www/19354/wwwroot/mobilpay/live.9T3M-CQ3Y-ETWA-R58F-43TPprivate.key';

		try
		{
		$objPmReq = Mobilpay_Payment_Request_Abstract::factoryFromEncrypted($_POST['env_key'], $_POST['data'], $privateKeyFilePath);
		#uncomment the line below in order to see the content of the request
		//print_r($objPmReq);
		$rrn = $objPmReq->objPmNotify->rrn;
		// action = status only if the associated error code is zero
		$servername = "mysql.cupfocsani.ro";
		$username = "cupfocsaniro";
		$password = "Canap1";
		$dbname = "cupfocsaniro_cupfcs";
		// Create connection
		$conn = new mysqli($servername, $username, $password, $dbname);
		// Check connection
		if ($conn->connect_error) {
		    die("Connection failed: " . $conn->connect_error);
		} 
  	switch($objPmReq->objPmNotify->action)
  	{

		#orice action este insotit de un cod de eroare si de un mesaj de eroare. Acestea pot fi citite folosind $cod_eroare = $objPmReq->objPmNotify->errorCode; respectiv $mesaj_eroare = $objPmReq->objPmNotify->errorMessage;
		#pentru a identifica ID-ul comenzii pentru care primim rezultatul platii folosim $id_comanda = $objPmReq->orderId;
		case 'confirmed':
			#cand action este confirmed avem certitudinea ca banii au plecat din contul posesorului de card si facem update al starii comenzii si livrarea produsului
		//update DB, SET status = "confirmed/captured"
 		$errorMessage = $objPmReq->objPmNotify->errorMessage;
 		//$errorMessage = "Tranzactie finalizata";
		$id_comanda = $objPmReq->orderId;
		$action  = $objPmReq->objPmNotify->action;
		$sql = "UPDATE mobilpay SET stare_comanda = '$action' WHERE orderid = '$id_comanda' ";

		if ($conn->query($sql) === TRUE) {
		    //echo "Record updated successfully";
		} else {
		    //echo "Error updating record: " . $conn->error;
		}
		$conn->close();
	    break;
		case 'confirmed_pending':
			#cand action este confirmed_pending inseamna ca tranzactia este in curs de verificare antifrauda. Nu facem livrare/expediere. In urma trecerii de aceasta verificare se va primi o noua notificare pentru o actiune de confirmare sau anulare.
		//update DB, SET status = "pending"
 		$errorMessage = $objPmReq->objPmNotify->errorMessage;
 		//$errorMessage = "In verificare antifrauda";
		$id_comanda = $objPmReq->orderId;
		$action  = $objPmReq->objPmNotify->action;
		$sql = "UPDATE mobilpay SET stare_comanda = '$action' WHERE orderid = '$id_comanda' ";

		if ($conn->query($sql) === TRUE) {
		    //echo "Record updated successfully";
		} else {
		    //echo "Error updating record: " . $conn->error;
		}
		$conn->close();
	    break;
		case 'paid_pending':
			#cand action este paid_pending inseamna ca tranzactia este in curs de verificare. Nu facem livrare/expediere. In urma trecerii de aceasta verificare se va primi o noua notificare pentru o actiune de confirmare sau anulare.
		//update DB, SET status = "pending"
 		$errorMessage = $objPmReq->objPmNotify->errorMessage;
 		//$errorMessage = "In verificare";
		$id_comanda = $objPmReq->orderId;
		$action  = $objPmReq->objPmNotify->action;
		$sql = "UPDATE mobilpay SET stare_comanda = '$action' WHERE orderid = '$id_comanda' ";

		if ($conn->query($sql) === TRUE) {
		    //echo "Record updated successfully";
		} else {
		    //echo "Error updating record: " . $conn->error;
		}
		$conn->close();
	    break;
		case 'paid':
			#cand action este paid inseamna ca tranzactia este in curs de procesare. Nu facem livrare/expediere. In urma trecerii de aceasta procesare se va primi o noua notificare pentru o actiune de confirmare sau anulare.
		//update DB, SET status = "open/preauthorized"
		$errorMessage = $objPmReq->objPmNotify->errorMessage;
 		//$errorMessage = "In curs de procesare";
		$id_comanda = $objPmReq->orderId;
		$action  = $objPmReq->objPmNotify->action;
		$error_code = $objPmReq->objPmNotify->errorCode;
		if($error_code!=0){
			$sql = "UPDATE mobilpay SET stare_comanda = 'rejected' WHERE orderid = '$id_comanda' ";
			if ($conn->query($sql) === TRUE) {
			    //echo "Record updated successfully";
			} else {
			    //echo "Error updating record: " . $conn->error;
			}
			$conn->close();				
		}else{
			$sql = "UPDATE mobilpay SET stare_comanda = '$action' WHERE orderid = '$id_comanda' ";
			if ($conn->query($sql) === TRUE) {
			    //echo "Record updated successfully";
			} else {
			    //echo "Error updating record: " . $conn->error;
			}
			$conn->close();	
		}
	    break;
		case 'canceled':
			#cand action este canceled inseamna ca tranzactia este anulata. Nu facem livrare/expediere.
		//update DB, SET status = "canceled"
		$errorMessage = $objPmReq->objPmNotify->errorMessage;
 		//$errorMessage = "Tranzactie anulata";
		$id_comanda = $objPmReq->orderId;
		$action  = $objPmReq->objPmNotify->action;
		$sql = "UPDATE mobilpay SET stare_comanda = '$action' WHERE orderid = '$id_comanda' ";

		if ($conn->query($sql) === TRUE) {
		    //echo "Record updated successfully";
		} else {
		    //echo "Error updating record: " . $conn->error;
		}
		$conn->close();
	    break;
		case 'credit':
			#cand action este credit inseamna ca banii sunt returnati posesorului de card. Daca s-a facut deja livrare, aceasta trebuie oprita sau facut un reverse. 
		//update DB, SET status = "refunded"
		$errorMessage = $objPmReq->objPmNotify->errorMessage;
 		//$errorMessage = "Returnare fonduri";
		$id_comanda = $objPmReq->orderId;
		$action  = $objPmReq->objPmNotify->action;
		$sql = "UPDATE mobilpay SET stare_comanda = '$action' WHERE orderid = '$id_comanda' ";

		if ($conn->query($sql) === TRUE) {
		    //echo "Record updated successfully";
		} else {
		    //echo "Error updating record: " . $conn->error;
		}
		$conn->close();
    break;
default:
	$errorType		= Mobilpay_Payment_Request_Abstract::CONFIRM_ERROR_TYPE_PERMANENT;
    $errorCode 		= Mobilpay_Payment_Request_Abstract::ERROR_CONFIRM_INVALID_ACTION;
    $errorMessage 	= 'mobilpay_refference_action paramaters is invalid';
    break;
  	}
		
		// else {
		// //update DB, SET status = "rejected"
		// $errorMessage = $objPmReq->objPmNotify->errorMessage;
		// 	}
		}
		catch(Exception $e)
		{
			$errorType 		= Mobilpay_Payment_Request_Abstract::CONFIRM_ERROR_TYPE_TEMPORARY;
			$errorCode		= $e->getCode();
			$errorMessage 	= $e->getMessage();
		}
	}
	else
	{
		$errorType 		= Mobilpay_Payment_Request_Abstract::CONFIRM_ERROR_TYPE_PERMANENT;
		$errorCode		= Mobilpay_Payment_Request_Abstract::ERROR_CONFIRM_INVALID_POST_PARAMETERS;
		$errorMessage 	= 'mobilpay.ro posted invalid parameters';
	}
}
else 
{
	$errorType 		= Mobilpay_Payment_Request_Abstract::CONFIRM_ERROR_TYPE_PERMANENT;
	$errorCode		= Mobilpay_Payment_Request_Abstract::ERROR_CONFIRM_INVALID_POST_METHOD;
	$errorMessage 	= 'invalid request metod for payment confirmation';
}

header('Content-type: application/xml');

echo "<?xml version='1.0' encoding='utf-8'?>";

if($errorCode == 0)
{
	echo "<crc>{$errorMessage}</crc>";
	//echo "Variabilele post sunt:";
foreach ($_POST as $key => $value) {
    //echo "Field ".htmlspecialchars($key)." is<br> ".htmlspecialchars($value)."<br>";
}

//echo "Variabilele GET sunt:";
foreach ($_GET as $key => $value) {
    //echo "Field ".htmlspecialchars($key)." is<br> ".htmlspecialchars($value)."<br>";
}
}


else

{
	echo "<crc error_type={$errorType} error_code={$errorCode}>{$errorMessage}</crc>";
	//echo "Variabilele post sunt:";
foreach ($_POST as $key => $value) {
    //echo "Field ".htmlspecialchars($key)." is<br> ".htmlspecialchars($value)."<br>";
}

//echo "Variabilele GET sunt:";
foreach ($_GET as $key => $value) {
   // echo "Field ".htmlspecialchars($key)." is<br> ".htmlspecialchars($value)."<br>";
}
}

