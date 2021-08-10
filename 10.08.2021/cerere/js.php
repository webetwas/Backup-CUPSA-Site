	<!--  <script type="text/javascript" src="assets/js/numscroller-1.0.js"></script> -->
	<script type="text/javascript" src="assets/js/sticky-sidebar.js"></script>
	<script type="text/javascript" src="assets/js/YouTubePopUp.jquery.js"></script>
	<script type="text/javascript" src="assets/js/owl.carousel.min.js"></script>
	<script type="text/javascript" src="assets/js/imagesloaded.min.js"></script>
	<script type="text/javascript" src="assets/js/wow.min.js"></script>
	<script type="text/javascript" src="assets/js/custom.js"></script>
	<script type="text/javascript" src="assets/js/popper.min.js"></script>
	<script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="assets/js/jquery.matchHeight-min.js"></script>

		<script type="text/javascript">
		var tpj = jQuery;

		var revapi38;
		tpj(document).ready(function() {
			if (tpj("#rev_slider_38_1").revolution == undefined) {
				revslider_showDoubleJqueryError("#rev_slider_38_1");
			} else {
				revapi38 = tpj("#rev_slider_38_1").show().revolution({
					sliderType: "standard",
					jsFileLocation: "//localhost/revslider-standalone/revslider/public/assets/revslider/assets/js/",
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


	</script>
<!--popover-->