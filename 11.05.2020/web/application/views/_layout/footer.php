	<!--  <script type="text/javascript" src="assets/js/numscroller-1.0.js"></script> -->


	<script type="text/javascript" src="<?=base_url();?>public/assets/js/sticky-sidebar.js"></script>
	<script type="text/javascript" src="<?=base_url();?>public/assets/js/YouTubePopUp.jquery.js"></script>
	<script type="text/javascript" src="<?=base_url();?>public/assets/js/owl.carousel.min.js"></script>
	<script type="text/javascript" src="<?=base_url();?>public/assets/js/imagesloaded.min.js"></script>
	<script type="text/javascript" src="<?=base_url();?>public/assets/js/wow.min.js"></script>
	<script type="text/javascript" src="<?=base_url();?>public/assets/js/custom.js"></script>
	<script type="text/javascript" src="<?=base_url();?>public/assets/js/popper.min.js"></script>
	<script type="text/javascript" src="<?=base_url();?>public/assets/js/bootstrap.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.min.js"></script>
	<!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.css" /> -->
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
	<div id="test-popup" class="white-popup mfp-hide">
		<div class="popup-content">
			<div class="container">
				<div class="row">
				<h2 class="main_title">Politica Cookies</h2>

					<p>Un <strong>“Internet Cookie”</strong> (termen cunoscut și ca “browser cookie” sau “HTTPS cookie” sau pur și simplu “cookie”) este un fișier de mici dimensiuni, format din litere și numere, care va fi stocat pe computerul, terminalul mobil sau alte echipamente ale unui utilizator de pe care se accesează Internetul. Cookie-ul este instalat prin solicitarea emisă de către un web-server unui browser (ex: Internet Explorer, Chrome) și este complet “pasiv” (nu conține programe software, viruși sau spyware și nu poate accesa informațiile de pe hard-disk-ul utilizatorului). Un cookie este format din 2 părți: numele și continutul sau valoarea cookie-ului. Mai mult, durata de existență a unui cookie este determinată; tehnic, doar webserverul care a trimis cookie-ul îl poate accesa din nou în momentul în care un utilizator se întoarce pe website-ul asociat webserverului respectiv.</p>


					<hr />
						<p><h3>Site-ul Companiei de Utilitati Publice Focsani <br /><a href="http://www.cupfocsani.ro">www.cupfocsani.ro</a> foloseste cookie-uri.</h3></p>
					<hr />

					<p><strong>Cum pot opri cookie-urile?</strong><br/>
					Utilizatorii își pot configura browserul să respingă fișierele cookie. Dezactivarea și refuzul de a primi cookie-uri pot face anumite secțiuni / pagini impracticabile sau dificil de vizitat și folosit (de exemplu: completarea online a formularelor / difuzarea clipului de informare publică, etc.). Mai multe informații despre cookie-uri puteți găsi pe site-ul <a href="http://www.allaboutcookies.org">www.allaboutcookies.org</a> sau <a href="http://www.youronlinechoices.com/ro">http://www.youronlinechoices.com/ro</a>.</p>

					<p>
						<button type="button" class="btn btn-primary" onClick="closePopup();">INCHIDE</button>
					</p>

				</div>
			</div>
		</div>

	</div>

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
		    $.magnificPopup.open({
		      items: { src: '#test-popup' },
		      type: 'inline'
		    }, 0);

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