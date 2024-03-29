<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'welcome';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['acasa'] = "welcome/index";
// $route['contact'] = "welcome/page/contact";
$route['p/comunicate-de-presa'] = "media/comunicate";
$route['p/intrebari_frecvente'] = "intrebari_frecvente";
$route['p/contact'] = "contact";
$route['p/(.*)'] = "pagini/p/$1";
$route['singlep/(.*)'] = "pagini/single_post/$1";
$route['sucursale'] = "sucursale/p/35";


$route['site_de_prezentare'] = "welcome/page/site_de_prezentare";
$route['site_magazin_online'] = "welcome/page/site_magazin_online";
$route['site_catalog_produse'] = "welcome/page/site_catalog_produse";
$route['site_tematic'] = "welcome/page/webpage_tematice";
$route['dezvoltare_site_nou'] = "welcome/page/dezvoltare_site_nou";
$route['dezvoltare_aplicatii_web'] = "welcome/page/dezvoltare_aplicatii_web";
$route['promovare_google_adwords'] = "welcome/page/promovare_google_adwords";
$route['promovare_facebook'] = "welcome/page/promovare_facebook";
$route['promovare_follow_links'] = "welcome/page/promovare_follow_links";