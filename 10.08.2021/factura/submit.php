<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


//include($_SERVER['HOME']."/web/application/views/pagini/database.inc.php");

define("SERVERNAME_CUPFOCSANI", "mysql.cupfocsani.ro");
define("USER_CUPFOCSANI", "cupfocsaniro");
define("PASS_CUPFOCSANI", "Canap1");
define("DB_CUPFOCSANI", "cupfocsaniro_cupfcs");

$con=mysqli_connect('mysql.cupfocsani.ro','cupfocsaniro','Canap1','cupfocsaniro_cupfcs');

// Check connection
if ($con->connect_error) {
  die("Connection failed: " . $con->connect_error);
}



$msg="";
if(isset($_POST['nume']) && isset($_POST['adresa']) && isset($_POST['cod_client']) && isset($_POST['telefon']) && isset($_POST['email']) && isset($_POST['cnp_cif']) && isset($_POST['trans_factura']) && isset($_POST['trans_sms'])){
	$nume=mysqli_real_escape_string($con,$_POST['nume']);
	$adresa=mysqli_real_escape_string($con,$_POST['adresa']);
	$cod_client=mysqli_real_escape_string($con,$_POST['cod_client']);
	$telefon=mysqli_real_escape_string($con,$_POST['telefon']);
	$email=mysqli_real_escape_string($con,$_POST['email']);
	$cnp_cif=mysqli_real_escape_string($con,$_POST['cnp_cif']);
	$trimitere_factura=mysqli_real_escape_string($con,$_POST['trans_factura']);
	$trimitere_sms=mysqli_real_escape_string($con,$_POST['trans_sms']);
	


$sql = "INSERT INTO factura_electronica(nume,adresa,cod_client,telefon,email,cnp_cif,trimitere_factura,trimitere_sms)
VALUES ('$nume','$adresa','$cod_client','$telefon','$email','$cnp_cif','$trimitere_factura','$trimitere_sms')";

if ($con->query($sql) === TRUE) {
  echo " ";
} else {
  echo "Error: " . $sql . "<br>" . $con->error;
}


$msg="Multumimi pentru optiunea aleasa";
	
	$html="
		<table>
			<tr>
				<td>Nume</td>
				<td>$nume</td>
			</tr>
			<tr>
				<td>Adresa</td>
				<td>$adresa</td>
			</tr>
			<tr>
				<td>Cod client</td>
				<td>$cod_client</td>
			</tr>
			<tr>
				<td>Telefon</td>
				<td>$telefon</td></tr>
			<tr>
				<td>Email</td>
				<td>$email</td>
			</tr>
			<tr>
				<td>CNP/CIF</td>
				<td>$cnp_cif</td>
			</tr>
			<tr>
				<td>Trimitere factura</td>
				<td>$trimitere_factura</td>
			</tr>
			<tr>
				<td>Trimitere sms</td>
				<td>$trimitere_sms</td>
			</tr>
		</table>
		
		<p>
			Imi exprim CONSIMTAMANTUL pentru prelucrarea datelor cu caracter personal mentionate mai sus de catre operatorul CUP Focsani in scopul:<br><br>
		Transmitere factura pentru serviciile de apa si/sau canalizare pe adresa de e-mail: $trimitere_factura
			
			Imi exprim CONSIMTAMANTUL pentru prelucrarea datelor cu caracter personal mentionate mai sus de catre operatorul CUP Focsani in scopul:<br><br>
		Transmitere de mesaje tip SMS referitoare la serviciile de apa si canalizare (avarii, lucrari programate, situatia plătilor, a soldului debitor/creditor etc exclus mesaje de marketing): $trimitere_sms
			
			Am fost informat ca imi pot retrage consimtamantul oricand. Retragerea consimtamantului nu afecteaza legalitatea prelucrarii efectuate pe baza consimtamantului inainte de retragerea acestuia<br><br>
			------------------------------------------------------------------------------------------------<br><br>
			
			Informare conform cu art. 13 din Regulamentul GDPR 679/2016<br><br>
			
			1) identitatea si datele de contact ale operatorului:<br>S.C. COMPANIA DE UTILITATI PUBLICE S.A. FOCSANI, str. N.Titulescu, Nr. 9, tel. 0237 226 401, e-mail secretariat@cupfocsani.ro<br><br>
			
			2) datele de contact ale responsabilului cu protectia datelor:<br>dpo@cupfocsani.ro, tel. 0237238531<br><br>
			
			3) scopurile in care sunt prelucrate datele cu caracter personal, precum si temeiul juridic al prelucrarii:<br>
			
			scop 1. transmiterea facturii pentru serviciile de apa si/sau canalizare pe adresa de e-mail<br>
			
			scop 2. transmiterii de mesaje tip SMS referitoare la serviciile de apa si canalizare (avarii, lucrari programate, situatia platilor, exclus mesaje de marketing). Temeiul juridic al prelucrarii il reprezinta:<br>
			- executarea Contractului pentru serviciile de apa si canalizare la care persoana vizata este parte<br>
			- interesul legitim urmarit de operator pentru care s-a facut Evaluarea interesului legitim. Interesul legitim este reprezentat de transmiterea facturilor cat mai rapid, in siguranta si avand costuri scazute catre utilizatori. Un alt interes legitim este reprezentat de informarea in timp real a utilizatorilor despre aparitia unor avarii pe reteaua publica sau despre situatia facturilor emise, a soldului debitor/creditor etc.<br><br>
			
			4) destinatarii sau categoriile de destinatari ai datelor cu caracter personal<br>Personalul CUP Focsani care are sarcini de serviciu sa prelucreze aceste date cu caracter personal, institutiile statului care in baza legii pot solicita aceste date, iar operatorul este obligat sa le transmita<br><br>
			
			5) perioada pentru care vor fi stocate datele cu caracter personal sau, daca acest lucru nu este posibil, criteriile utilizate pentru a stabili aceasta perioada;<br>Datele sunt stocate pe toata perioada contractuala sau pana cand utilizatorul isi exercita dreptul de stergere (pentru datele care pot fi sterse) al lor.<br><br>
			
			6) aveti dreptul de a solicita operatorului, rectificarea sau stergerea datelor sau restrictionarea prelucrarii sau dreptul de a va opune prelucrarii, precum si dreptul la portabilitatea datelor; atunci cand prelucrarea se bazeaza pe articolul 6 alineatul (1) litera (a) sau pe articolul 9 alineatul (2) litera (a), aveti dreptului de va retrage consimtamantul in orice moment, fara a afecta legalitatea prelucrarii efectuate pe baza consimtamantului inainte de retragerea acestuia; aveti <b>dreptul de a depune o plangere in fata unei autoritati de supraveghere;<br><br>
			
			7) daca furnizarea de date cu caracter personal reprezinta o obligatie legala sau contractuala sau o obligatie necesara pentru incheierea unui contract, precum si daca persoana vizata este obligata sa furnizeze aceste date cu caracter personal si care sunt eventualele consecinte ale nerespectarii acestei obligatii;<br>In situatia in care va exercitati dreptul de stergere sau dreptul de a va opune prelucrarii asupra datelor cu caracter personal de genul nume, prenume, adresa, informatii referitoare la distributia retelelor in interiorul imobilului etc, nu vom mai putea fi masura continuarii relatiilor contractuale.<br><br>
			
			8) existenta unui proces decizional automatizat incluzand crearea de profiluri, mentionat la articolul 22 alineatele (1) si (4), precum si, cel putin in cazurile respective, informatii pertinente privind logica utilizata si privind importanta si consecintele preconizate ale unei astfel de prelucrari pentru persoana vizata.<br>În cadrul activitatii operatorului NU exista un proces decizional automatizat sau crearea de profiluri.<br><br>
			
			9) In cazul in care operatorul intentioneaza sa prelucreze ulterior datele cu caracter personal intr-un alt scop decat cel pentru care acestea au fost colectate, operatorul furnizeaza persoanei vizate, inainte de aceasta prelucrare ulterioara, informatii privind scopul secundar respectiv si orice informatii suplimentare relevante, in conformitate cu alineatul (2).<br>In masura in care obligatiile legale NU impun o alta prelucrare, datele colectate NU vor fi prelucrate in alt scop decat cel mentionat mai sus.
		</p>

		";
	
	// include('smtp/PHPMailerAutoload.php');
	//echo $_SERVER['DOCUMENT_ROOT']."/factura/smtp/PHPMailerAutoload.php";
	// include($_SERVER['DOCUMENT_ROOT']."/factura/smtp/PHPMailerAutoload.php");

			include("<?php echo base_url();?>factura/smtp/PHPMailerAutoload.php");
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
		//$mail->send();

		if(!$mail->send()) {
			echo 'Mesajul a fost trimis cu succes.';
			echo 'Mailer Error: ' . $mail->ErrorInfo;
		} else {
			echo 'Mesajul a fost trimis cu succes';
		}
			echo $msg;
}
?>	