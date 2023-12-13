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
$route['default_controller'] = 'admin153';
$route['login'] = 'admin153';
$route['login/validate'] = 'Admin153_login/validate';
$route['login/updpass'] = 'Admin153_login/updpass';

$route['logout'] = 'Admin153_login/logout';
$route['dashboard'] = 'Admin153_dashboard';

$route['master'] = 'Admin153_master';
$route['master/(:any)'] = 'Admin153_master/$1';
$route['master/(:any)/(:any)'] = 'Admin153_master/$1/$2';

$route["userlist"] = "Admin153_master/listuser";

$route['iuran'] = 'Admin153_iuran';
$route['iuran/alldata'] = 'Admin153_iuran/alldata';
$route['iuran/(:any)'] = 'Admin153_iuran/iuran/$1';
$route['iuran/(:any)/(:any)'] = 'Admin153_iuran/iuran/$1/$2';
$route['iuran/(:any)/(:any)/notnull'] = 'Admin153_iuran/iuran/$1/$2/$3';

$route["report"] = "Admin153_report";
$route["soon"] = "admin153/soon";


$route['xhttp'] = 'Xhttp';
$route['xhttp/jurnal/(:num)'] = 'Xhttp/xhr/$1';

$route['xhr'] = 'ajax';
$route['xhr/(:any)'] = 'ajax/$1';
$route['xhr/(:any)/(:any)'] = 'ajax/$1/$2';
$route['xhr/(:any)/(:any)/(:any)'] = 'ajax/$1/$2/$3';

$route['data'] = 'Admin153_data';
$route['data/(:any)'] = 'Admin153_data/$1';
$route['data/(:any)/(:any)'] = 'Admin153_data/$1/$2';
$route['data/(:any)/(:any)/notnull'] = 'Admin153_data/$1/$2/$3';

$route['pinjaman'] = 'Admin153_pinjaman';
$route['pinjaman/(:any)'] = 'Admin153_pinjaman/$1';
$route['pinjaman/(:any)/(:any)'] = 'Admin153_pinjaman/$1/$2';
$route['pinjaman/(:any)/(:any)/notnull'] = 'Admin153_pinjaman/$1/$2/$3';

$route['laporan'] = 'Admin153_laporan';
$route['laporan/(:any)'] = 'Admin153_laporan/$1';
$route['laporan/(:any)/(:any)'] = 'Admin153_laporan/$1/$2';
$route['laporan/(:any)/(:any)/notnull'] = 'Admin153_laporan/$1/$2/$3';
/*
$route['xhr']='ajax';
$route['xhr/(:any)']='ajax/$1';
$route['xhr/(:any)/(:any)']='ajax/$1/$2';    

$route['qrlogin']='Admin153_login/qrlogin';
$route['qrlogin/(:any)']='Admin153_login/qrlogin/$1';
*/
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
