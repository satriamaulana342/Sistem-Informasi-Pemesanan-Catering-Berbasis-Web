<?php
defined('BASEPATH') or exit('No direct script access allowed');

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
|	https://codeigniter.com/userguide3/general/routing.html
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
$route['default_controller'] = 'user';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

// AUTH
$route['login'] = 'auth';
$route['registrasi'] = 'auth/registrasi';
$route['lupa_password'] = 'auth/lupa_password';
$route['reset_password'] = 'auth/reset_password';
$route['reset_password_form/(:any)'] = 'auth/reset_password_form/$1';
$route['process_reset_password/(:any)'] = 'auth/process_reset_password/$1';
$route['logout'] = 'auth/logout';

// USER
$route['home'] = 'user';
$route['about'] = 'user/about';
$route['faq'] = 'user/faq';
$route['kontak'] = 'user/kontak';
$route['keranjang'] = 'user/keranjang';
$route['checkout'] = 'user/checkout';
$route['transaksi'] = 'user/transaksi';
$route['pesanan'] = 'user/pesanan';
$route['paket'] = 'user/paket';
$route['prasmanan'] = 'user/prasmanan';
$route['profile'] = 'user/profile';


$route['detail/(:any)'] = 'user/detail/$1';
$route['detail_custom/(:any)'] = 'user/detail_custom/$1';
$route['detail_prasmanan/(:any)'] = 'user/detail_prasmanan/$1';
$route['detail_custom_prasmanan/(:any)'] = 'user/detail_custom_prasmanan/$1';
