<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Cookie</title>
	
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">

</head>

<body>
	

</head>
<body>


<div id="cookie" class="modal fade in">
    <div class="inner-modal">
        <div class="modal-container">
        	<div class="container border-modal">
	            <div class="row">
	            	<div class="text-modal"> 	
	            	<h3>Policita Cookies <span class="label label-primary label-xs">Compania de Utilitati Publice Focsani</span></h3>
					Un “Internet Cookie” (termen cunoscut și ca “browser cookie” sau “HTTPS cookie” sau pur și simplu “cookie”) este un fișier de mici dimensiuni, format din litere și numere, care va fi stocat pe computerul, terminalul mobil sau alte echipamente ale unui utilizator de pe care se accesează Internetul. Cookie-ul este instalat prin solicitarea emisă de către un web-server unui browser (ex: Internet Explorer, Chrome) și este complet “pasiv” (nu conține programe software, viruși sau spyware și nu poate accesa informațiile de pe hard-disk-ul utilizatorului). Un cookie este format din 2 părți: numele și continutul sau valoarea cookie-ului. Mai mult, durata de existență a unui cookie este determinată; tehnic, doar webserverul care a trimis cookie-ul îl poate accesa din nou în momentul în care un utilizator se întoarce pe website-ul asociat webserverului respectiv.<br />
					<hr>
					<div class="text-center">Site-ul <strong>Companiei de Utilitati Publice Focsani</strong> <a href="cupfocsani.ro">www.cupfocsani.ro</a> foloseste cookie-uri. [<a href="" > detalii... </a>]</div>
					<hr>
					<h3>Cum pot opri cookie-urile?</h3> 
					Utilizatorii își pot configura browserul să respingă fișierele cookie. Dezactivarea și refuzul de a primi cookie-uri pot face anumite secțiuni / pagini impracticabile sau dificil de vizitat și folosit (de exemplu: completarea online a formularelor / difuzarea clipului de informare publică, etc.). Mai multe informații despre cookie-uri puteți găsi pe site-ul 
					<a href="www.allaboutcookies.org" target="_blank"> www.allaboutcookies.org</a> sau <a href="http://www.youronlinechoices.com/ro" target="_blank">http://www.youronlinechoices.com/ro</a>.
				</div>
            </div>
            <button id="cookieClose" class="close" data-dismiss="modal" data-target="#cookie" style="background-color: white; padding: 10px; border-radius: 10px;">Inchide & Accept</button>
            </div>
        </div>
    </div>  
</div>


<style>

	
	.container{
		background-color: #333333;
		margin-top: 10%;
	}
	.border-modal{
		border:solid 4px white;
		border-radius: 10px; 
		padding: 30px;
	}
	.text-modal{
		color: #f2f2f2;
		text-align: justify;
	}

	.text-modal a{
		color: #f2f2f2;
	}

	hr {
		color:#333333;
	}

	strong{
		color:#f2f2f2;
	}

	h3{
		margin-left: 30px;
	}

</style>


<script>
	$(document).ready(function () {
	    //if cookie hasn't been set...
	    if (document.cookie.indexOf("ModalShown=false")<0) {
	        $("#cookie").modal("show");
	        //Modal has been shown, now set a cookie so it never comes back
	        $("#cookieClose").click(function () {
	            $("#cookie").modal("hide");
	        });
	        document.cookie = "ModalShown=true; expires=Fri, 31 Dec 9999 23:59:59 GMT; path=/";
	    }
	});
</script>

</body>
</html>