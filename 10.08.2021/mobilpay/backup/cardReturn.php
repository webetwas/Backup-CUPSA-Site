<?php 
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);
 ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
	<title>Cup Focsani | Finalizare Plata Online</title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta http-equiv="author" content="NETOPIA" />
	<meta http-equiv="copyright" content="(c)NETOPIA" />
	<meta http-equiv="rating" content="general" />
	<meta http-equiv="distribution" content="general" />

	

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
	
	<link rel="stylesheet" href="../mobilpay/css/style.css" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<style>
		.align{
			margin:10% auto;  
			border-radius: 10px; 
			width: 30%;
			text-align: center
		}
		strong{
			color: #4d4dff;
		}

		.btn{
			margin: 5px;
		}
	</style>


</head>

<body>


<center class="align">

	<div class="col-lg-12 text-center m-t">
		<div class="text-center">
			<p style="text-align: left;">			
				<?php
					$con=new mysqli("mysql.cupfocsani.ro","cupfocsaniro","Canap1","cupfocsaniro_cupfcs");
						if($con->connect_err){
							die("CONEXIUNEA LA BAZA DE DATE A FOST REFUZATA!");
						}
						$oidfalse=$_GET['orderId'];
						$oid=$con->real_escape_string($oidfalse);
						$sql=$con->query("SELECT * FROM mobilpay WHERE orderid = '".$oid."'");
						$res=$sql->fetch_assoc();
				?>

				<?php 
					$errorCode = 0;

					if($res['stare_comanda']=="confirmed"){
						echo ("<h3>Tranzactia a fost finalizata cu succes</h3>" . "<br />" . "<div style='display:none;'>" . "Id plata: " . $_GET['orderId'] . "</div>" . "<br />" . "Cod client: " . $res['codclient'] . "<br />" . "Suma: " . $res['suma'] .  " " . "Lei" . "<br />" . "Adresa:" . $res['adresa'] . "<br/>" . "Telefon:" . $res['telefon'] ."<br />" . "<a href='http://cupfocsani.ro' class='btn btn-info'>Înapoi în site</a>");		
					}					

					if($res['stare_comanda']=="confirmed_pending"){
						echo ("<h3>Tranzactia este in verificare</h3>" . "<br />" . "<div style='dispaly:none'>" . "Id plata: " . $_GET['orderId'] . "<br />" . "</div>" . "Cod client: " . $res['codclient'] . "<br />" . "<br />" . "Suma: " . $res['suma'] . " " . "Lei" . "<br />" . "Telefon:" . $res['telefon'] . "Adresa:" . $res['adresa'] . "<br />" . "<a href='http://cupfocsani.ro' class='btn btn-info'>Înapoi în site</a>");	
					}
					if($res['stare_comanda']=="rejected"){
						echo "Plata a fost respinsa, te rugam sa reincerci";	
					}
				 ?>

				<?php $con->close(); ?>
			</p>
		</div>
	</div>
	
</center>

</body>
</html>
