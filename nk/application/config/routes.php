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
if($_SERVER['HTTP_HOST'] == 'siak.nurulkarimah.sch.id' || $_SERVER['SERVER_PORT'] =="808"){
    $route['default_controller'] = 'siak';
    $route['login']='admin_siak/siak_login';
    $route['logout']='admin_siak/siak_login/logout';
    $route['login/validate']='admin_siak/siak_login/validate';
    $route['dashboard']='admin_siak/siak_dashboard';
    $route['master']='admin_siak/siak_master';
    $route['master/(:any)']='admin_siak/siak_master/$1';
    $route['master/(:any)/(:any)']='admin_siak/siak_master/$1/$2';    
    
    $route['tabungan']='admin_siak/siak_nabung';
    $route['tabungan/(:any)']='admin_siak/siak_nabung/$1';
    $route['tabungan/(:any)/(:any)']='admin_siak/siak_nabung/$1/$2';    
    $route['tabungan/(:any)/(:any)/notnull']='admin_siak/siak_nabung/$1/$2/$3';    

    $route['xhr']='admin_siak/ajax';
    $route['xhr/(:any)']='admin_siak/ajax/$1';
    $route['xhr/(:any)/(:any)']='admin_siak/ajax/$1/$2';    

    $route['qrlogin']='admin_siak/siak_login/qrlogin';
    $route['qrlogin/(:any)']='admin_siak/siak_login/qrlogin/$1';

}elseif($_SERVER['HTTP_HOST'] == 'siswa.nurulkarimah.sch.id' || $_SERVER['SERVER_PORT'] =="818"){
    $route['default_controller'] = 'csiswa';
    $route['login']='admin_siswa/siswa_login';
    $route['logout']='admin_siswa/siswa_login/logout';
    $route['login/validate']='admin_siswa/siswa_login/validate';
    $route['dashboard']='admin_siswa/siswa_dashboard';
    $route['profile']='admin_siswa/siswa_dashboard/profile';
    $route['profile/(:any)']='admin_siswa/siswa_dashboard/profile/$1';
    
    $route['xhr']='admin_siswa/ajax';
    $route['xhr/(:any)']='admin_siswa/ajax/$1';
    $route['xhr/(:any)/(:any)']='admin_siswa/ajax/$1/$2';    

    $route['qrlogin']='admin_siswa/siswa_login/qrlogin';
    $route['qrlogin/(:any)']='admin_siswa/siswa_login/qrlogin/$1';
    $route['qrlogin/cetaknis']='admin_siswa/siswa_login/qrlogin/create';
    

// echo $_SERVER['HTTP_HOST'];
}else{
    $route['default_controller'] = 'home';
}
$route['administrator']='admin/login';
$route['admin']='admin/dashboard';
$route['artikel']='berita';
$route['artikel']='berita/index';
$route['artikel/(:any)']='berita/detail/$1';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;