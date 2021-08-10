	<script type="text/javascript" src="<?=base_url();?>public/assets/js/sticky-sidebar.js"></script>
	<script type="text/javascript" src="<?=base_url();?>public/assets/js/YouTubePopUp.jquery.js"></script>
	<script type="text/javascript" src="<?=base_url();?>public/assets/js/owl.carousel.min.js"></script>
	<script type="text/javascript" src="<?=base_url();?>public/assets/js/imagesloaded.min.js"></script>
	<script type="text/javascript" src="<?=base_url();?>public/assets/js/wow.min.js"></script>
	<script type="text/javascript" src="<?=base_url();?>public/assets/js/custom.js"></script>
	<script type="text/javascript" src="<?=base_url();?>public/assets/js/popper.min.js"></script>
	<script type="text/javascript" src="<?=base_url();?>public/assets/js/bootstrap.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.min.js"></script>
	<link rel="stylesheet" type="text/css" href="<?=base_url();?>public/assets/css/cookies.css">
	
<style>
.popup-content {
	background-color: #fff;
	padding: 30px;
}
.mfp-content #test-popup {
	width: 60%;
	margin: 0 auto;
	position: relative;
}
.mfp-close {
	/* color: #fff !important; */
	font-size: 30px;
	right:0;
}
/* @media screen and (max-width: 1024px) {
	.mfp-close {
		color: #000 !important;
		font-size: 50px;
	}
	.mfp-content #test-popup {
		width: 100%;
		margin: 0 auto;
	}
} */
</style>



 <!-- Modal ---- GDPR --> 

<div id="myModal" class="modal fade">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
           
			<div class="modal-header">
				<h4 class="modal-title" style="text-align:center;">Centrul de preferințe pentru confidențialitate</h4>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
            <div class="modal-body">

				<div class="tab">
					<button class="tablinks" onclick="openCookies(event, 'Necesare')" id="defaultOpen">Cookie strict necesare</button>
					<button class="tablinks" onclick="openCookies(event, 'Nonnecesare')">Cookies Non-Necesare</button>
					<!-- <button class="tablinks" onclick="openCookies(event, 'Diverse')">Diverse</button> -->
					<button class="tablinks" >
						<a href="https://cookiepedia.co.uk/giving-consent-to-cookies" class="tablinks" style="text-decoration:none; color:black;" target="_blank">Mai multe informatii</a>
					</button>
				</div>

				<div id="Necesare" class="tabcontent">
					<h4 style="color:#80BE5A;">Tehnologii de tip Cookie strict necesare</h4>
					<p>
						Acest cookie este setat de site-uri web folosind anumite versiuni
						ale soluției de respectare a legii privind cookie-urile de la Cup Focsani. <br>
						Este setat după ce vizitatorii au văzut un aviz de informare privind
						cookie-urile și, în unele cazuri, numai atunci când închid în mod activ avizul.
						Acesta permite site-ului web să nu afișeze mesajul de mai multe ori unui utilizator.<br>
						<strong>Cookie-ul are o durată de viață de un an și nu conține informații personale.</strong>
					</p>
					<hr>
					<p>
						Cookie <strong>ci_session</strong> <br>
						Cookie asociat cu platforma website www.cupfocsani.ro. Este utilizat pentru a menține o stare de
						functionalitate în timpul unei sesiuni de browser pentru a constata experienței utilizatorului.
						În mod implicit, cookie-ul este distrus la încheierea sesiunii browserului.
					</p>
					<p>
						Informații prin Tehnologii de tip Cookie în Scopul sus-menționat (și tipul de fișiere folosite)<br>
						<div class="col-sm-5" style="text-align: center">
							<a href="http://www.cupfocsani.ro/p/politica-cookie">Politica Cookies</a>
						</div>
						<div class="col-sm-7" style="text-align: center">
							<a href="http://www.cupfocsani.ro/p/politica-de-confidentialitate">Politica de confidentialitate</a>
						</div>
					</p>
				</div>

				<div id="Nonnecesare" class="tabcontent">
					<h4>Cookies Non-necesare</h4>
					<p>web site-ul www.cupfocsani.ro nu prelucreaza cookies</p>
				</div>

				<div id="Diverse" class="tabcontent">
					<h3>Diverse</h3>
					<p>Diverse.</p>
				</div>
				<div style="clear:both"></div>
				<br>
				<div class="alert alert-info">
					<strong>NOTA:</strong> Cookie-urile de sesiune sunt stocate temporar în memoria browserului și sunt distruse atunci
					când este închis website-ul www.cupfocsani.ro.
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-success" data-dismiss="modal">Salveaza</button>
			</div>

		</div>

      </div>
  </div>

 <!-- Modal ---- GDPR -->


 <!-- Modal ---- factura electronica --> 

 <div id="myModal2" class="modal fade">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
           
			<div class="modal-header">
				<h3 class="modal-title" style="text-align:center;">Optiune</h3>
			</div>
            <div class="modal-body">

				<p style="text-align: justify">
					1. Dacă optați pentru <b style="color: green">DA</b> confirmați ambele scopuri.
					<br>
					2. Dacă optați <b style="color: red">NU</b> se va șterge numărul de telefon și nu veți mai putea fi anunțat în timp real despre eventualele avarii sau lucrări programate.
					<hr>
					<b>Scopurile</b>:<br />
					1. Transmitere factura pentru serviciile de apa si/sau canalizare pe adresa de e-mail<br>
					2. Transmitere de mesaje tip SMS referitoare la serviciile de apa si canalizare (avarii, lucrari programate, situația plăților, a soldului debitor/creditor etc exclus mesaje de marketing)
				</p>

		
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-success" value="input" data-dismiss="modal" onclick="sms_da()">DA</button>
				<button type="button" class="btn btn-danger" data-dismiss="modal" onclick="sms_nu()">NU</button>
			</div>

		</div>

      </div>
  </div>



<!--bifare toate checkbox-->

<script type="text/javascript">
	function sms_da(){
		$("#trans_sms").attr("checked","true");
		setTimeout(function(){ 
		$("#factura_electronica_submit").trigger("click");
		}, 500);
	}

	function sms_nu(){
		$("#inputPhone").val("");

		setTimeout(function(){ 
		$("#factura_electronica_submit").trigger("click");
		}, 500);
	}
</script>

<!--bifare toate checkbox-->


<!-- Modal ---- factura electronica -->




	<script type="text/javascript">
		var tpj = jQuery;

		var revapi38;
		tpj(document).ready(function() {
			if (tpj("#rev_slider_38_1").revolution == undefined) {
				revslider_showDoubleJqueryError("#rev_slider_38_1");
			} else {
				revapi38 = tpj("#rev_slider_38_1").show().revolution({
					sliderType: "standard",
					// jsFileLocation: "//localhost/revslider-standalone/revslider/public/assets/revslider/assets/js/",
					sliderLayout: "fullwidth",
					dottedOverlay: "none",
					delay: 9000,
					navigation: {
						onHoverStop: "off",
					},
					responsiveLevels: [1240, 1024, 778, 480],
					visibilityLevels: [1240, 1024, 778, 480],
					gridwidth: [1110, 1024, 778, 480],
					gridheight: [720, 720, 500, 500],
					lazyType: "none",
					shadow: 0,
					spinner: "spinner0",
					stopLoop: "off",
					stopAfterLoops: -1,
					stopAtSlide: -1,
					shuffle: "off",
					autoHeight: "off",
					disableProgressBar: "on",
					hideThumbsOnMobile: "off",
					hideSliderAtLimit: 0,
					hideCaptionAtLimit: 0,
					hideAllCaptionAtLilmit: 0,
					debugMode: false,
					fallbacks: {
						simplifyAll: "off",
						nextSlideOnWindowFocus: "off",
						disableFocusListener: false,
					}
				});
			}
		}); /*ready*/

	</script>


<!--popover-->
	<script type="text/javascript">

		$(function () {
		  $('.example-popover').popover({
		    container: 'body'
		  })
		});

		$('.js-equal').matchHeight({
			byRow: false
		});

		$('.js-equal-2').matchHeight();
		$('.js-equal-3').matchHeight();
		$('.js-equal-4').matchHeight();
		$('.js-equal-5').matchHeight();
		$('.js-equal-6').matchHeight();
		$('.js-equal-7').matchHeight();
		$('.js-equal-8').matchHeight();

		// $.magnificPopup.open({
		//   items: { src: '#test-popup' },
		//   type: 'inline'
		// }, 0);

		function closePopup() {
			$.magnificPopup.close();
		}
		$(window).on('load', function() {
		  var now, lastDatePopupShowed;
		  now = new Date();

		  if (localStorage.getItem('lastDatePopupShowed') !== null) {
		    lastDatePopupShowed = new Date(parseInt(localStorage.getItem('lastDatePopupShowed')));
		  }

		  if (((now - lastDatePopupShowed) >= (15 * 86400000)) || !lastDatePopupShowed) {
			/*
		    $.magnificPopup.open({
		      items: { src: '#test-popup' },
		      type: 'inline'
		    }, 0);
			*/
			$("#myModal").modal({
				show: true,
				backdrop: 'static', 
				keyboard: false
			});

		    localStorage.setItem('lastDatePopupShowed', now);
		  }
});


	</script>

<!--popover-->


<!--disable ctrl+c & right click-->
<script>
	    $(function() {
        $(this).bind("contextmenu", function(e) {
            e.preventDefault();
        });
    });
</script>

<script language="javascript">
	function Disable_Control_C() {
		var keystroke = String.fromCharCode(event.keyCode).toLowerCase();

			if (event.ctrlKey && (keystroke == 'c' || keystroke == 'v')) {
			alert("Nu copia textul");
			event.returnValue = false; // disable Ctrl+C
			}
		}
</script>
<!--disable ctrl+c & right click-->

<script>
function openCookies(evt, cookieName) {
  var i, tabcontent, tablinks;
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablinks");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");
  }
  document.getElementById(cookieName).style.display = "block";
  evt.currentTarget.className += " active";
}

// Get the element with id="defaultOpen" and click on it
document.getElementById("defaultOpen").click();
</script>

<!--disable ctrl+c & right click-->




		