<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
	<title>Confirmare Completare Formular Plata Online</title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta http-equiv="author" content="NETOPIA" />
	<meta http-equiv="copyright" content="(c)NETOPIA" />
	<meta http-equiv="rating" content="general" />
	<meta http-equiv="distribution" content="general" />

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<link rel="stylesheet" href="css/style.css" />

</head>

<body >
<img src="img/giphy.gif" class="loading-gif"/>
	<div class="jumbotron" style="margin:0 auto;">
		<div class="text-center">
	    		<div class="col-sm-12 text-center m-t">
					<?php
					require_once 'Mobilpay/Payment/Request/Abstract.php';
					require_once 'Mobilpay/Payment/Request/Card.php';
					require_once 'Mobilpay/Payment/Invoice.php';
					require_once 'Mobilpay/Payment/Address.php';
                                        include($_SERVER['DOCUMENT_ROOT'].'/config_db_mobile_pay/config_variables.php');
					#for testing purposes, all payment requests will be sent to the sandbox server. Once your account will be active you must switch back to the live server https://secure.mobilpay.ro
					#in order to display the payment form in a different language, simply add the language identifier to the end of the paymentUrl, i.e https://secure.mobilpay.ro/en for English
					// $paymentUrl = 'http://sandboxsecure.mobilpay.ro';
					$paymentUrl = 'https://secure.mobilpay.ro';
					// this is the path on your server to the public certificate. You may download this from Admin -> Conturi de comerciant -> Detalii -> Setari securitate
					$x509FilePath 	= 'live.9T3M-CQ3Y-ETWA-R58F-43TP.public.cer';
					try
					{
						srand((double) microtime() * 1000000);
						$objPmReqCard 						= new Mobilpay_Payment_Request_Card();
						#merchant account signature - generated by mobilpay.ro for every merchant account
						#semnatura contului de comerciant - mergi pe www.mobilpay.ro Admin -> Conturi de comerciant -> Detalii -> Setari securitate
						$objPmReqCard->signature 			= '9T3M-CQ3Y-ETWA-R58F-43TP';
						#you should assign here the transaction ID registered by your application for this commercial operation
						#order_id should be unique for a merchant account
						$orderidd=md5(uniqid(rand()));
						#below is where mobilPay will send the payment result. This URL will always be called first; mandatory
						
						//ok - am inteles problema dar unde este xml respectiv
						$objPmReqCard->confirmUrl 			= 'http://cupfocsani.ro/mobilpay/cardConfirm.php';
						#below is where mobilPay redirects the client once the payment process is finished. Not to be mistaken for a "successURL" nor "cancelURL"; mandatory

						//ok - am inteles problema dar unde este xml respectiv
						$objPmReqCard->returnUrl 			= 'http://cupfocsani.ro/mobilpay/cardReturn.php';

						#detalii cu privire la plata: moneda, suma, descrierea
						#payment details: currency, amount, description
						$objPmReqCard->invoice = new Mobilpay_Payment_Invoice();
						#payment currency in ISO Code format; permitted values are RON, EUR, USD, MDL; please note that unless you have mobilPay permission to
						#process a currency different from RON, a currency exchange will occur from your currency to RON, using the official BNR exchange rate from that moment
						#and the customer will be presented with the payment amount in a dual currency in the payment page, i.e N.NN RON (e.ee EUR)
						$objPmReqCard->invoice->currency	= 'RON';
						$objPmReqCard->invoice->amount		= $_POST['amount'];
						#available installments number; if this parameter is present, only its value(s) will be available
						//$objPmReqCard->invoice->installments= '2,3';
						#selected installments number; its value should be within the available installments defined above
						//$objPmReqCard->invoice->selectedInstallments= '3';
					        //platile ulterioare vor contine in request si informatiile despre token. Prima plata nu va contine linia de mai jos.
						// $objPmReqCard->invoice->details		=  "Nr. Factura: {$_POST['numarFactura']}" . " | " . "Cod client: {$_POST['codclient']}" ;
					    $objPmReqCard->invoice->tokenId = uniqid();
						// $objPmReqCard->orderId 				= $orderidd;
						//$orderidd = $_POST['numarFactura'];
						$objPmReqCard->orderId = $orderidd;
					    $objPmReqCard->invoice->details		= "{$_POST['codclient']}" ;

						#detalii cu privire la adresa posesorului cardului
						#details on the cardholder address (optional)
						$billingAddress 				= new Mobilpay_Payment_Address();
						$billingAddress->type			= 'person';//$_POST['billing_type']; //should be "person"
						$billingAddress->firstName		= $_POST['billing_first_name'];
						$billingAddress->lastName		= $_POST['billing_last_name'];
						// $billingAddress->address		= "{$_POST['codclient']} | {$_POST['numarFactura']}";
						$billingAddress->address		= $_POST['billing_address'];
						$billingAddress->email			= $_POST['billing_email'];
						$billingAddress->mobilePhone	= $_POST['billing_mobile_phone'];
						$objPmReqCard->invoice->setBillingAddress($billingAddress);

						#detalii cu privire la adresa de livrare

						#details on the shipping address
						$shippingAddress 				= new Mobilpay_Payment_Address();
						$shippingAddress->type			= $_POST['shipping_type'];
						$shippingAddress->firstName		= $_POST['shipping_first_name'];
						$shippingAddress->lastName		= $_POST['shipping_last_name'];


// add new 
						// $shippingAddress->address		= $_POST['shipping_address'];
						// $shippingAddress->mobilePhone	= $_POST['shipping_mobile_phone'];
// add new


						// $shippingAddress->address		= "{$_POST['codclient']} | {$_POST['numarFactura']}";
						$shippingAddress->email			= $_POST['billing_email'];
						// $shippingAddress->mobilePhone	= "Cod client: ".$_POST['codclient'];


						
						$shippingAddress->mobilePhone	= $_POST['shipping_mobile_phone'];
						$objPmReqCard->invoice->setShippingAddress($shippingAddress);

						#uncomment the line below in order to see the content of the request
						//echo "<pre>";print_r($objPmReqCard);echo "</pre>";
						$objPmReqCard->encrypt($x509FilePath);
					}
					catch(Exception $e)
					{
					}
					?>


				<div class="row">
					<?php if(!($e instanceof Exception)):?>



<!--salvare in baza de date-->						
						<?php
							$con = new mysqli(SERVERNAME_CUPFOCSANI, USER_CUPFOCSANI, PASS_CUPFOCSANI, DB_CUPFOCSANI);
							if($con->connect_err){
								die("CONEXIUNEA LA BAZA DE DATE A FOST REFUZATA!");
							}

								$sql=$con->prepare("INSERT INTO mobilpay(orderid, codclient, suma) VALUES (?, ?, ?)");
								$sql->bind_param("sss",$orderidd,$_POST['codclient'],$_POST['amount']);
									if(!$sql->execute()){
										die("ERROARE LA QUERY!");
									}
								else
								{
								
							}
						?>
<!--salvare in baza de date-->

					<p>
						<form name="frmPaymentRedirect" method="post" action="<?php echo $paymentUrl;?>">
						<input type="hidden" name="env_key" value="<?php echo $objPmReqCard->getEnvKey();?>"/>
						<input type="hidden" name="data" value="<?php echo $objPmReqCard->getEncData();?>"/>

						<!-- <p>Veti fi redirectionat catre pagina de plata..</p> -->

						</form>
						<script type='text/javascript'>
							document.frmPaymentRedirect.submit();
						</script>
					</p>

					<!--
					<script type="text/javascript" language="javascript">
						window.setTimeout(document.frmPaymentRedirect.submit(), 5000);
					</script>
					-->


					<?php else:?>

					<div class="alert alert-danger"><?php echo $e->getMessage();?></div>

					<?php endif;?>
				</div>

			</div>
	</div>
</div>

</body>
</html>