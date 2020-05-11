<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!DOCTYPE html>
<html lang="en-US">
<head>
	<title><?=(isset($title_browser_ro) && !is_null($title_browser_ro) ? $title_browser_ro : "No Title ;-)")?></title>
	<meta name="author" content="WebEtwas">
	<meta name="robots" content="index follow">
	<meta name="googlebot" content="index follow">
	<meta http-equiv="content-type" content="text/html; charset=utf-8">
	<meta name="keywords" content="<?=(isset($keywords) && !is_null($keywords) ? $keywords : "")?>">
	<meta name="description" content="<?=(isset($meta_description) && !is_null($meta_description) ? $meta_description : "")?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!-- google fonts -->
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,800%7CPoppins:300i,400,700,400i,500%7CDosis:300" rel="stylesheet">
	<!-- animate -->
	<link rel="stylesheet" href="<?=base_url();?>public/assets/css/animate.css" />
	<!-- owl Carousel assets -->
	<link href="<?=base_url();?>public/assets/css/owl.carousel.css" rel="stylesheet">
	<link href="<?=base_url();?>public/assets/css/jquery.realperson.css" rel="stylesheet">
	<link href="<?=base_url();?>public/assets/css/owl.theme.css" rel="stylesheet">
	<!-- bootstrap -->
	<link rel="stylesheet" href="<?=base_url();?>public/assets/css/bootstrap.min.css">
	<!-- hover anmation -->
	<link rel="stylesheet" href="<?=base_url();?>public/assets/css/hover-min.css">
	<!-- flag icon -->
	<link rel="stylesheet" href="<?=base_url();?>public/assets/css/flag-icon.min.css">
	<!-- main style -->
	<link rel="stylesheet" href="<?=base_url();?>public/assets/css/style.css">
	<!-- right-menu style -->
	<link rel="stylesheet" href="<?=base_url();?>public/assets/right-menu.css">
	<!-- colors -->
	<link rel="stylesheet" href="<?=base_url();?>public/assets/css/colors/main.css">
	<!-- elegant icon -->
	<link rel="stylesheet" href="<?=base_url();?>public/assets/css/elegant_icon.css">

	<!-- jquery library  -->
	<script type="text/javascript" src="<?=base_url();?>public/assets/js/jquery-3.2.1.min.js"></script>
	<!-- fontawesome
	<script src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>   -->
	<!-- google maps api  -->
	<!-- <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script> -->
	<script type="text/javascript" src="<?=base_url();?>public/assets/js/jquery.gomap-1.3.3.min.js"></script>

	<!-- MatchHeight Equal -->
	<script type="text/javascript" src="<?=base_url();?>public/assets/js/jquery.matchHeight-min.js"></script>

	<!-- REVOLUTION STYLE SHEETS -->
	<link rel="stylesheet" type="text/css" href="<?=base_url();?>public/assets/revslider/fonts/pe-icon-7-stroke/css/pe-icon-7-stroke.css">
	<link rel="stylesheet" type="text/css" href="<?=base_url();?>public/assets/revslider/fonts/font-awesome/css/font-awesome.css?v=1000">
	<link rel="stylesheet" type="text/css" href="<?=base_url();?>public/assets/revslider/css/settings.css">
	<!-- REVOLUTION LAYERS STYLES -->

	<!--GDPT HOME-->
	<link rel="stylesheet" type="text/css" href="<?=base_url();?>public/assets/gdpr/css/magnific-popup.css">
	<!-- <link rel="stylesheet" type="text/css" href="<?=base_url();?>public/assets/gdpr/css/custom.css">  -->

	<!--GDPT HOME-->

	<!-- REVOLUTION JS FILES -->
	<script type="text/javascript" src="<?=base_url();?>public/assets/revslider/js/jquery.themepunch.tools.min.js"></script>
	<script type="text/javascript" src="<?=base_url();?>public/assets/revslider/js/jquery.themepunch.revolution.min.js"></script>

	<!-- SLIDER REVOLUTION 5.0 EXTENSIONS  (Load Extensions only on Local File Systems !  The following part can be removed on Server for On Demand Loading) -->
	<script type="text/javascript" src="<?=base_url();?>public/assets/revslider/js/extensions/revolution.extension.actions.min.js"></script>
	<script type="text/javascript" src="<?=base_url();?>public/assets/revslider/js/extensions/revolution.extension.carousel.min.js"></script>
	<script type="text/javascript" src="<?=base_url();?>public/assets/revslider/js/extensions/revolution.extension.kenburn.min.js"></script>
	<script type="text/javascript" src="<?=base_url();?>public/assets/revslider/js/extensions/revolution.extension.layeranimation.min.js"></script>
	<script type="text/javascript" src="<?=base_url();?>public/assets/revslider/js/extensions/revolution.extension.migration.min.js"></script>
	<script type="text/javascript" src="<?=base_url();?>public/assets/revslider/js/extensions/revolution.extension.navigation.min.js"></script>
	<script type="text/javascript" src="<?=base_url();?>public/assets/revslider/js/extensions/revolution.extension.parallax.min.js"></script>
	<script type="text/javascript" src="<?=base_url();?>public/assets/revslider/js/extensions/revolution.extension.slideanims.min.js"></script>
	<script type="text/javascript" src="<?=base_url();?>public/assets/revslider/js/extensions/revolution.extension.video.min.js"></script>

	<style media="screen">
		.owl-carousel .owl-controls {
			/* position: absolute; */
	    width: 70%;
			bottom: calc( 0px + 15px );
	    margin-left: 15%;
		}
		.owl-carousel.main-one .owl-prev {
			float: left;
			position: absolute;
			left: 60px;
			bottom: 8px;
		}
		.owl-carousel.main-one .owl-next {
			float: right;
			position: absolute;
			right: 60px;
			bottom: 8px;
		}
		.owl-carousel-1 .owl-controls {
			position: absolute;
			right: 0;
			top: 0;
			width: auto;

		}
		.owl-theme .owl-controls {
			margin-top: 0;
		}
		.sticky {
		  position: fixed;
		  top: 0;
		  width: 100%;
			z-index: 9;
		}
		.sticky + .content {
		  padding-top: 60px;
		}
		.one-slide {
			background-size: cover;
			background-repeat: no-repeat;
			background-position: 50% 50%;
			padding: 200px 0;
			/* width: 100vw; */
			height: 600px;
		}
		@media screen and (max-width: 1024px) {
			.one-slide {
				/* padding: 50px 0; */
				height: auto;
			}
		}
		.one-slide::after {
			content: '';
			/* background-color: rgba(0, 0, 0, 0.63); */
			position: absolute;
			display: block;
			top: 0;
			bottom: 0;
			left: 0;
			right: 0;
		}
		.slider-content {
			position: absolute;
			z-index: 99999;
			background-color: rgba(255, 255, 255, 0.76);
			padding: 50px;
			border-radius: 3px;
			bottom: 0;
			left: 50%;
			transform: translate(-50%, -12%);
		}

	</style>

	<style>
		#right-menu {
			position: fixed;
			/*position: absolute;*/
			right: 0;
			top: 9%;
			width: 10em;
			/*margin-top: -2.5em;*/
			/*margin-top: -3.1em;*/
			margin-top: 20.9em;
			border: solid 1px #5091c8 ;
			border-top-left-radius:10px;
			border-bottom-left-radius:10px;
			border-right:0;
			padding: 5px 5px 5px 0;
			background-color: white;
			z-index: 1030;
		}
		.padding-icon{
			padding: 0 10px 0 0;
		}

	</style>


	<!--share-->

		<script type='text/javascript' src='//platform-api.sharethis.com/js/sharethis.js#property=5cf64e496d8ead0012d76b23&product=sticky-share-buttons' async='async'></script>
	
	<!--share-->

	<!--share two-->
	



<!-- 	<meta property="og:title" content="Comapnia de Utilitati Publice" />
	<meta property="og:url" content="http://www.cupfocsani.ro" />
	<meta property="og:image" content="http://sharethis.com/images/logo.jpg" />
	<meta property="og:description" content="" />
	<meta property="og:site_name" content="CUP Focsani" /> -->


</head>
