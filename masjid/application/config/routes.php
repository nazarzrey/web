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
#$route['default_controller'] = 'welcome';
$route['default_controller'] 	= 'front_page';
$route['santunan'] 	= 'front_page';
$route['nama'] 					= 'login/wrg';
$route['nama/(:any)']			= 'login/warga/$1';
$route['nama/(:any)/(:any)']	= 'login/warga/$1/$2';
$route['infaq']					= 'front_page/warga';
$route['infaq/(:any)']			= 'front_page/infaq/$1';
$route['cetak']					= 'front_page/cetak';
$route['cetak/(:any)']			= 'front_page/cetak/$1';
$route['revisi']				= 'front_page/revisi';
$route['revisi/(:any)']			= 'front_page/revisi/$1';
$route['admin']					= 'backend_page';
$route['admin/(:any)']			= 'backend_page/page/$1';
$route['warga/(:any)']			= 'warga/xdata/$1';
$route['galeri']				= 'front_page/gambar';
$route['404']					= 'front_page/p404';


// $route['nama/(:any)'] 			= 'front_page/warga/$1';
/*
$route['login'] 			 				= 'login';
$route['admin']  		 	 				= 'backend_page';
$route['admin/laporan'] 	 	 			= 'backend_page/report';
$route['admin/laporan/(:any)/(:any)'] 	 	= 'backend_page/report/$1/$2';
$route['admin/laporan/(:any)/(:any)/(:any)']= 'backend_page/report/$1/$2/$3';

$route['admin/users'] 	 	 				= 'backend_page/users';
$route['admin/users/(:any)'] 	 			= 'backend_page/users/$1';
$route['admin/users/(:any)/(:any)'] 	 	= 'backend_page/users/$1/$2';

$route['admin/export'] 	 	 				= 'backend_page/export';
$route['admin/export/(:any)/(:any)'] 	 	= 'backend_page/export/$1/$2';

$route['admin/find'] 	 	 				= 'backend_page/cari';
$route['admin/find/(:any)/(:any)'] 	 		= 'backend_page/cari/$1/$2';

$route['admin/pdf'] 	 	 				= 'backend_page/xpdf';
$route['admin/pdf/(:any)/(:any)'] 	 		= 'backend_page/xpdf/$1/$2';

$route['admin/dtl/(:any)'] 	 				= 'backend_page/detail/$1';

$route['xhr/find'] 	 	 					= 'ajax/cari';
$route['xhr/find/(:any)/(:any)'] 	 		= 'ajax/cari/$1/$2';

$route['xhr/pdf'] 	 	 					= 'ajax/xpdfAjax';
$route['xhr/xpdf/(:any)/(:any)'] 	 		= 'ajax/xpdfAjax/$1/$2';

$route['soon'] 	 	 						= 'backend_page/soon';

$route['peta/(:any)'] 	 	 				= 'backend_page/maps/$1';
$route['admin/frm'] 	 	 				= 'crud';
$route['admin/frm/(:any)'] 	 				= 'crud/$1';
$route['admin/frm/(:any)/(:any)'] 	 		= 'crud/$1/$2';
$route['admin/frm/(:any)/(:any)/(:any)'] 	= 'crud/$1/$2/$3';

$route['xhr']  		 	 					= 'ajax';
$route['xhr/post/(:any)'] 	 				= 'ajax/post_content/$1';
$route['xhr/post/(:any)/(:any)'] 	 		= 'ajax/post_content/$1/$2';
#$route['xhr/post/save_settings'] 	 		= 'ajax/post_other';
$route['xhr/get/(:any)'] 	 				= 'ajax/get_content/$1';
$route['xhr/get/(:any)/(:any)'] 	 		= 'ajax/get_content/$1/$2';
$route['xhr/get/(:any)/(:any)/(:any)'] 		= 'ajax/get_content/$1/$2/$3';

$route['xhr/dtl/(:any)'] 	 				= 'ajax/dataLaporan/$1';
$route['xhr/seting/(:any)'] 				= 'ajax/datasettings/$1';
$route['xhr/seting/(:any)/(:any)']			= 'ajax/datasettings/$1/$2';
$route['xhr/settings/save']					= 'ajax/post_other';*/

$route['404_override'] 						= '';
$route['translate_uri_dashes'] 				= FALSE;
