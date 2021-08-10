<?php
function rpHash($value)
{
	$hash = 5381;
	$value = strtoupper($value);
	for ($i = 0; $i < strlen($value); $i++) {
		$hash = (($hash << 5) + $hash) + ord(substr($value, $i));
	}
	return $hash;
}


$client = !empty($_GET['client']) ? $_GET['client'] : null;
$factura = !empty($_GET['factura']) ? $_GET['factura'] : null;
$suma = !empty($_GET['suma']) ? $_GET['suma'] : null;
// $adresa = !empty($_GET['adresa']) ? $GET['adresa']: null;
// $telefon =!empty($_GET['telefon']) ? $GET['telefon']: null;


?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
	<title>Compania de Utilități Publice Focșani - Plata online cu cardul</title>

	<meta http-equiv="author" content="NETOPIA" />
	<meta http-equiv="copyright" content="(c)NETOPIA" />
	<meta http-equiv="rating" content="general" />
	<meta http-equiv="distribution" content="general" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<link rel="stylesheet" href="css/style.css" />
	<link href="<?php echo "http://" . $_SERVER['SERVER_NAME'] ?>/public/assets/css/jquery.realperson.css" rel="stylesheet">


	<style>
		input[type=number]::-webkit-inner-spin-button,
		input[type=number]::-webkit-outer-spin-button {
			-webkit-appearance: none;
			margin: 0;
		}

		.img_client {
			display: block;
			padding-top: 269px;
			width: auto;
			background-position: top right;
			background-size: cover;
			background-repeat: no-repeat;
			position: relative;
			z-index: 1;
		}

		.img_client .em {
			color: #000;
			font-weight: 600;
			font-size: 15px;
			font-style: italic;
		}

		.large-logo-pay {
			position: absolute;
			z-index: 0;
			transform: translate(-50%, -50%);
			left: 50%;
			top: 50%;
		}

		h6 {
			font-weight: normal;
			text-align: left;
		}

		.agreed {
			width: auto;
		}

		.show-terms-s {
			display: none;
			position: absolute;
			background-color: #fff;
			top: 50%;
			left: 50%;
			transform: translate(-50%, -50%);
			height: auto;
			padding: 20px;
			height: auto;
			border-radius: 5px;
		}

		.popup-content {
			overflow: hidden;
			overflow-y: auto;
			height: 70vh;
			max-height: 600px;
			margin-bottom: 20px;
			max-width: 700px;
		}

		.show-terms {
			position: fixed;
			display: none;
			left: 0;
			right: 0;
			top: 0;
			bottom: 0;
			background: rgba(0, 0, 0, .8);
		}

		.position-relative {
			min-height: 300px;
		}

		.vertical-center {
			margin: 0;
			position: absolute;
			top: 50%;
			-ms-transform: translateY(-50%);
			transform: translateY(-50%);
		}
		@media(max-width: 991px){
			.show-terms-s{
				position: relative;
				top: 0;
				left: 0;
				transform: translate(0%, 0%);
				margin: 15px;
			}
			.popup-content{
				max-width: none;
				height: 60vh;
			}
		}
	</style>

</head>

<body>

	<?php
	if ($_GET['client'] == 21686) {
		die("<center><h4>Linkul nu poate fi procesat!</h4><br/><a href='index.php' class='btn btn-success btn-sm'>Reincearca</a></center>");
	}
	?>


	<div class="jumbotron">
		<div class="container">
			<div class="m-t">
				<div class="col-lg-12">
					<div class="border">
						<div class="text-center">
							<h4><a href="javascript:void(0)">Compania de Utilitati Publice - Plata online cu cardul</a></h4>
							<h5>Plata va fi realizata prin portalul de plati securizat mobilpay.ro</h5>
						</div>
						<div class="text-center alert alert-danger">
						Pentru moment, secțiunea pentru realizarea Plății Online nu este disponibilă, fiind în derulare proceduri de actualizare a platformei.<br\>  Ne cerem scuze pentru acest inconvenient, care sperăm să fie de scurtă durată.
						</div>
						<form action="cardRedirect.php" method="post" name="frmPaymentRedirect">
							<fieldset>
								<div class="row">
									<div class="col-lg-6">
										<div class="col-lg-12 col-xs-12">
											<label>Cod client:</label>
											<input class="form-control form-control-md just-numbers" type="number" name="codclient" id="codClient" required placeholder="de pe factura dvs.*" oninvalid="InvalidMsg(this);" value="<?php echo $client; ?>" onkeydown="javascript: return event.keyCode === 8 || event.keyCode === 46 ? true : !isNaN(Number(event.key))" />
										</div>

										<!--
											<div class="col-lg-12 col-xs-12">
												<label>Număr factură:</label>
												<input class="form-control form-control-md just-numbers" type="number" name="numarFactura" id="numarFactura" placeholder="de pe factura dvs. *" oninvalid="InvalidMsg(this);" value="<?php //echo $factura;?>" onkeydown="javascript: return event.keyCode === 8 || event.keyCode === 46 ? true : !isNaN(Number(event.key))" />
											</div>
										-->

										<div class="col-lg-12 col-xs-12">
											<label>Sumă RON:</label>
											<input class="form-control form-control-md just-numbers" type="number" step="0.01" name="amount" min="1" required placeholder="introdu suma dorită* | separator zecimal este punct" oninvalid="InvalidMsg(this);" value="<?php echo $suma; ?>" />

											<input type="hidden" name="billing_bank" />
											<input type="hidden" name="billing_iban" />
										</div>

										<div class="col-lg-12 col-xs-12">
											<label>Telefon:</label>
											<input class="form-control form-control-md" type="text" name="billing_mobile_phone" required placeholder="introdu telefon" oninvalid="InvalidMsg(this);" value="" />
										</div> 

										<div class="col-lg-12 col-xs-12">
											<label>Adresa:</label>
											<input class="form-control form-control-md" type="text" name="billing_address" required placeholder="introdu adresa din factura" oninvalid="InvalidMsg(this);" value="" />
										</div> 
										
										 <div class="col-lg-12 col-xs-12">
											<label>Adresa Email:</label>
											<input class="form-control form-control-md" type="email" name="billing_email" required placeholder="introdu email pentru confirmare plata" oninvalid="InvalidMsg(this);" value="" />
										</div> 
										
										<input class="form-control form-control-md" type="hidden" name="billing_mobile_phone" required value="-" />
										<input class="form-control form-control-md" type="hidden" name="billing_address" required value="-" />
										<!-- <div class="col-lg-12 col-xs-12">
											<label>Adresa Email:</label>
											<input class="form-control form-control-md" type="email" name="email" required placeholder="introdu email pentru confirmare plata" oninvalid="InvalidMsg(this);" value="" />
										</div> -->

									</div>

									<div class="col-lg-6 position-relative">
										<img src="openimage/large-logo.jpg" class="large-logo-pay" alt="">
										<a href="openimage/factura-cup-cod.jpg" class="cod_client img_client" style="background-image: url('openimage/factura-cup-cod.jpg'); display: none;">
											<center>
												<div class="em"><i class="fas fa-search-plus"></i>
													Click pe imagine pentru mărire.
												</div>
											</center>
										</a>
										<a href="openimage/factura-cup-numar.jpg" class="numar_client img_client" style="background-image: url('openimage/factura-cup-numar.jpg'); display: none;">
											<center>
												<div class="em"><i class="fas fa-search-plus"></i>
													Click pe imagine pentru mărire.
												</div>
											</center>
										</a>
									</div>
								</div>

								<div class="row">
									<div class="col-sm-4">
										<h6>
											<input type="checkbox" name="checkbox" class="agreed" required />
											<i>Confirm că datele de mai sus adăugate sunt conform realității</i>
										</h6>
									</div>
									<div class="col-sm-4">
										<h6>
											<input type="checkbox" name="checkbox" class="agreed" id="agreed-terms" required />
											<i>
												Sunt de acord cu <u>Termeni și Condiții</u>
											</i>
										</h6>
									</div>
									<div class="col-sm-4">
										<h6>
											<input type="checkbox" name="checkbox" class="agreed" required />
											<i>
												Am fost informat cu privire la <u><a href="http://cupfocsani.ro/p/politica-de-confidentialitate" target="_blank">Politica de Confidențialitate</a></u> a operatorului CUP SA Focșani
											</i>
										</h6>
									</div>
								</div>

								<div class="row">
									<div class="col-sm-12">
										<em>*Toate câmpurile sunt obligatorii</em>
									</div>
								</div>


							</fieldset>

							<div class="col-sm-12">
									<div class="row alert alert-info text-center">
										<blockquote>
										În cazul în care nu puteți trece la următorul pas, vă rugăm să folosiți un browser de internet diferit de cel cu care sunteți conectat (ex.
										<a href="https://support.microsoft.com/ro-ro/help/17621/internet-explorer-downloads">Internet Explorer, Edge</a>,
										<a href="https://www.opera.com/ro?utm_campaign=%2300%20-%20WW%20-%20Search%20-%20EN%20-%20Branded&gclid=Cj0KCQjw3qzzBRDnARIsAECmryrlE3izayRb7EpnAkOz7nDZGetmdvzxZKUi9zH9L1B2F3u4APm95jYaAmFCEALw_wcB"> Opera</a>,
										<a href="https://www.mozilla.org/ro/firefox/">Mozilla</a>,
										<a href="https://www.google.com/chrome/?brand=CHBD&gclid=Cj0KCQjw3qzzBRDnARIsAECmryrjLP1yGi7fDdBQYCC3hbXVPldhDzuQX-encn71AhR2ZIITnvIaFv8aAggJEALw_wcB&gclsrc=aw.ds">Chrome</a>,
										<a href="https://support.apple.com/downloads/safari">Safari</a> etc.)
									</blockquote>
								</div>
							</div>
							<input type="text" class="form-control" name="captcha" value="" placeholder="Introduceți codul de mai sus" id="captcha" required>
							<div class="col-lg-12 text-center">
								<div class="text-center">
									<a href="http://cupfocsani.ro" class="btn btn-light btn-sm">Înapoi în site</a>
									<input type="submit" value="Mergi mai departe" class="btn btn-light btn-sm" name="submit">
								</div>
							</div>
						</form>

						<!-- <hr />
						<div class="alert alert-success" role="alert">
							<h1 class="text-center"><span style="color:#246332;">Momentan pagina de plata este in teste.</span></h1>
						</div> -->

						<hr />
						<blockquote style="text-align: justify;">
							<em><span>În situația în care nu doriți ca datele dumneavoastră cu caracter personal (nume, cod client, detalii card) să fie prelucrate prin acest sistem de plată, vă așteptăm în casierii pentru achitarea directă a facturii. Prin continuarea efectuării plății în acest mod, vă exprimați consimțământul ca datele dumneavoastră cu caracter personal să fie prelucrate de operatorul CUP S.A. Focșani, operatorul Netopia și operatorul Banca Transilvania, în scopul decontării serviciilor facturate. Consimțământul dat poate fi retras oricând, printr-o notificare scrisă a operatorului CUP S.A. Focșani.</span></em>
						</blockquote>

					</div>
				</div>

			</div>

		</div>
	</div>
	<div class="show-terms">
		<div class="show-terms-s" id="popup-content">
			<div class="popup-content" name="container_terms">
				<div class="content-wrapper" style="height: auto;">
					<?php

					$con = new mysqli("mysql.cupfocsani.ro", "cupfocsaniro", "Canap1", "cupfocsaniro_cupfcs");
					$con->set_charset("utf8");
					if ($con->connect_err) {
						die("CONEXIUNEA LA BAZA DE DATE A FOST REFUZATA!");
					}
					$sql = $con->query("SELECT * FROM fe_pages WHERE atom_id='206' ");
					$res = $sql->fetch_assoc();
					?>

					<?php
					echo $res["content_ro"];
					?>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-12 text-center">
					<blockquote style="text-align: center;">
						<em><span>Cititi/Derulati pana la finalul textului, pentru activarea butonului <strong style="color: #218838">Sunt de acord</strong></span></em>
					</blockquote>
					<hr />
					<button id="closeTerms" class="btn btn-success btn-sm" disabled name="agree">Sunt de acord</button>
				</div>
			</div>
		</div>
	</div>

	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.min.js"></script>




	<!--change image-->
	<script>
		function numarClient(id, target, hideClass) {

			$(id).on("click", function(event) {
				$(target).toggle();
				event.stopPropagation();
				//$(target).addClass()
				$(hideClass).hide();
			});

			$(target).on("click", function(event) {
				event.stopPropagation();
			});

			$(document).on("click", function(event) {
				$(target).hide();
			});
		}

		numarClient("#codClient", ".cod_client", ".numar_client");
		numarClient("#numarFactura", ".numar_client", ".cod_client");

		$('.cod_client').magnificPopup({
			type: 'image'
			// other options
		});


		$('.numar_client').magnificPopup({
			type: 'image'
			// other options
		});

		$('#agreed-terms').click(function() {
			$(".show-terms, .show-terms-s").toggle(this.checked);
			currentHeight = $('.popup-content').outerHeight();
			wrapperHeight = $('.content-wrapper').outerHeight();

			console.log("set current height on load = " + currentHeight);

			console.log(wrapperHeight);

			(function($) {
				$.fn.hasScrollBar = function() {
					return this.get(0).scrollHeight > this.height();
				}
			})(jQuery);


			(function($) {
				$.fn.hasScrollBar = function() {
					return this.get(0).scrollHeight > this.height();
				}
			})(jQuery);

			console.log($('.popup-content').hasScrollBar());
			if ($('.popup-content').hasScrollBar() == false) {
				$('#closeTerms').removeAttr('disabled');
			}
		});

		$('.popup-content').scroll(function() {
			if( ( $(this)[0].scrollHeight - $(this).scrollTop() - $(this).outerHeight() ) < 1 ){
				console.log("botom");
				$('#closeTerms').removeAttr('disabled');
			}
			/*
			if ($(this).scrollTop() == $(this)[0].scrollHeight - $(this).height()) {
				$('#closeTerms').removeAttr('disabled');
			}
			*/
		});

		/*
		function checkScrollHeight() {
			var agreementTextElement = document.getElementsByName("container_terms")[0];

			if (agreementTextElement.clientHeight + agreementTextElement.scrollTop >= agreementTextElement.scrollHeight) {
				document.getElementsByName("agree")[0].disabled = false;
			}
		}

		document.getElementsByName("container_terms")[0].addEventListener("scroll", checkScrollHeight, false);
		*/

		$('#closeTerms').click(function() {
			$(".show-terms, .show-terms-s").hide();
		});
	</script>
	<!--//change image-->


	<!--show error romanian-->
	<script>
		function InvalidMsg(input) {

			if (input.value == '') {
				input.setCustomValidity('Camp Obligatoriu de Completat');
			} else {
				input.setCustomValidity('');
			}
			return true;
		}
	</script>
	<!--//show error romanian-->


	<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>

	<!--cod antispam-->
	<script src="jquery.plugin.js" type="text/javascript"></script>
	<script src="jquery.realperson.js" type="text/javascript"></script>

	<script>
		$("#captcha").realperson({
			length: 3,
		});
		$('#captcha').realperson( 'disable' );
		$("#captcha").removeAttr('disabled');
		$(".realperson-regenbtn.btn-primary").hide();
		//var captcha_hash = $("#captcha").realperson('getHash');
		//$(document).on('click', '.realperson-regenbtn.btn-primary', function(){
			//captcha_hash = $("#captcha").realperson('getHash');
		//});


		$("form").submit(function(e) {
			var corect_captcha = false;
			var captcha_val = $('input[name="captcha"]').val();
			var captcha_hash = $('input[name="captchaHash"]').val();
			$.ajax({
				async: false,
				type: "GET",
				url: 'rpHash.php',
				data: {
					captcha_val: captcha_val
				},
				success: function(data) {
					if (data == captcha_hash) {
						//alert(data);
						corect_captcha = true;
					} else {
						alert("Codul introdus este greșit! Vă rugăm să verificați.");
					}
				}
			});
			if (corect_captcha == false) {
				e.preventDefault();
			}
		});
	</script>
	<!--//cod antispam-->





</body>

</html>
