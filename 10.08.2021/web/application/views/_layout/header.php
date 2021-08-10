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
	<link rel="stylesheet" href="<?=base_url();?>public/assets/css/animate.css?v=0.00000001" />
	<!-- owl Carousel assets -->
	<link href="<?=base_url();?>public/assets/css/owl.carousel.css?v=0.00000001" rel="stylesheet">
	<link href="<?=base_url();?>public/assets/css/jquery.realperson.css?v=0.00000001" rel="stylesheet">
	<link href="<?=base_url();?>public/assets/css/owl.theme.css?v=0.00000001" rel="stylesheet">
	<!-- bootstrap -->
	<link rel="stylesheet" href="<?=base_url();?>public/assets/css/bootstrap.min.css?v=0.00000001">
	<!-- hover anmation -->
	<link rel="stylesheet" href="<?=base_url();?>public/assets/css/hover-min.css?v=0.00000001">
	<!-- flag icon -->
	<link rel="stylesheet" href="<?=base_url();?>public/assets/css/flag-icon.min.css?v=0.00000001">
	<!-- main style -->
	<link rel="stylesheet" href="<?=base_url();?>public/assets/css/style.css?v=0.00000001">
	<!-- right-menu style -->
	<link rel="stylesheet" href="<?=base_url();?>public/assets/right-menu.css?v=0.00000001">
	<!-- colors -->
	<link rel="stylesheet" href="<?=base_url();?>public/assets/css/colors/main.css?v=0.00000001">
	<!-- elegant icon -->
	<link rel="stylesheet" href="<?=base_url();?>public/assets/css/elegant_icon.css?v=0.00000001">

	<!-- jquery library  -->
	<script type="text/javascript" src="<?=base_url();?>public/assets/js/jquery-3.2.1.min.js"></script>

	<!-- MatchHeight Equal -->
	<script type="text/javascript" src="<?=base_url();?>public/assets/js/jquery.matchHeight-min.js"></script>

	<!-- REVOLUTION STYLE SHEETS -->
	<link rel="stylesheet" type="text/css" href="<?=base_url();?>public/assets/revslider/fonts/pe-icon-7-stroke/css/pe-icon-7-stroke.css?v=0.00000001">
	<link rel="stylesheet" type="text/css" href="<?=base_url();?>public/assets/revslider/fonts/font-awesome/css/font-awesome.css?v=1000">
	<link rel="stylesheet" type="text/css" href="<?=base_url();?>public/assets/revslider/css/settings.css?v=0.00000001">
	<!-- REVOLUTION LAYERS STYLES -->

	<!--GDPT HOME-->
	<link rel="stylesheet" type="text/css" href="<?=base_url();?>public/assets/gdpr/css/magnific-popup.css?v=0.00000001">
	<!-- <link rel="stylesheet" type="text/css" href="<?=base_url();?>public/assets/gdpr/css/custom.css?v=0.00000001">  -->

	<!--GDPT HOME-->

	<link rel="shortcut icon" type="image/png" href="<?=base_url();?>public/upload/img/favicon.png"/>

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

</head>
