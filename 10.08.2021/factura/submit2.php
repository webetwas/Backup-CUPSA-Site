<?php
include('database.inc.php');
$msg="";
if(isset($_POST['nume']) && isset($_POST['adresa']) && isset($_POST['cod_client']) && isset($_POST['telefon']) && isset($_POST['email']) && isset($_POST['cnp_cif']) && isset($_POST['trimitere_factura']) && isset($_POST['trimitere_sms'])){
	$nume=mysqli_real_escape_string($con,$_POST['nume']);
	$adresa=mysqli_real_escape_string($con,$_POST['adresa']);
	$cod_client=mysqli_real_escape_string($con,$_POST['cod_client']);
	$telefon=mysqli_real_escape_string($con,$_POST['telefon']);
	$email=mysqli_real_escape_string($con,$_POST['email']);
	$cnp_cif=mysqli_real_escape_string($con,$_POST['cnp_cif']);
	$trimitere_factura=mysqli_real_escape_string($con,$_POST['trimitere_factura']);
	$trimitere_sms=mysqli_real_escape_string($con,$_POST['trimitere_sms']);
	
	mysqli_query($con,"insert into factura_electronica(nume,adresa,cod_client,telefon,email,cnp_cif,trimitere_factura,trimitere_sms) values('$nume','$adresa','$cod_client','$telefon','$email','$cnp_cif','$trimitere_factura','$trimitere_sms')");
	$msg="Multumimi pentru optiunea aleasa";
	
	$html="<table><tr><td>Nume</td><td>$nume</td></tr><tr><td>Adresa</td><td>$adresa</td></tr><tr><td>Cod client</td><td>$cod_client</td></tr><tr><td>Telefon</td><td>$telefon</td></tr><tr><td>Email</td><td>$email</td></tr><tr><td>CNP/CIF</td><td>$cnp_cif</td></tr><tr><td>Trimitere factura</td><td>$trimitere_factura</td></tr><tr><td>Trimitere sms</td><td>$trimitere_sms</td></tr></table>";
	
	include('smtp/PHPMailerAutoload.php');
	$mail=new PHPMailer(true);
	$mail->isSMTP();
	$mail->Host="smtp.gmail.com";
	$mail->Port=587;
	$mail->SMTPSecure="tls";
	$mail->SMTPAuth=true;
	$mail->Username="ionel.panciu@gmail.com";
	$mail->Password="Akuku@1978";
	$mail->SetFrom("ionel.panciu@gmail.com");
	$mail->addAddress("ionel.panciu@gmail.com");
	$mail->IsHTML(true);
	$mail->Subject="Solicitare Factura Electronica";
	$mail->Body=$html;
	$mail->SMTPOptions=array('ssl'=>array(
		'verify_peer'=>false,
		'verify_peer_name'=>false,
		'allow_self_signed'=>false
	));
	if($mail->send()){
		//echo "Mesaj Trimis";
	}else{
		//echo "Eroare trimitere mesaj";
	}
	echo $msg;
}
?>