<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
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
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There area two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router what URI segments to use if those provided
| in the URL cannot be matched to a valid route.
|
*/
//$route['login'] = 'pws/login';
$route['index.aspx'] = 'main/page';
$route['crTPasswordInpuTResSetPassGo'] = 'login/inputpassword';
$route['default_controller'] = "web";


$route['reset-password'] = 'login/reset_password';
$route['act-reset-password'] = 'login/reset_password_aksi';
$route['reset-password-info'] = 'login/reset_password_info';


$route['about/(:num)']          = 'web/about/$1';
$route['newsevent/(:num)']      = 'web/newsevent/$1';
$route['ourproject/(:num)']     = 'web/ourproject/$1';
$route['agent/(:num)']          = 'web/agent/$1';
$route['partner/(:num)']        = 'web/partner/$1';
$route['certificate/(:num)']    = 'web/certificate/$1';
$route['kontak/(:num)']         = 'web/kontak/$1';
$route['produk-detail/(:any)/(:any)/(:num)'] = 'web/produkdetail/$1/$2/$3';
$route['login-member']          = 'web/login/';
$route['act_beli']              = 'web/simpan_kekeranjang_belanja';
$route['cart']                  = 'web/keranjang_belanja';
$route['cart-hapus/(:num)']     = 'web/keranjang_belanja_hapus/$1';
$route['logout-member']         = 'web/keluar/';
$route['beranda']               = 'web/index/';
$route['daftar-member']         = 'web/daftar/';
$route['auth-member']           = 'web/authlogin/';
$route['produk/(:any)/(:num)']  = 'web/produk/$1/$2';
$route['detail/(:any)/(:num)/(:num)']   = 'web/konten_detail/$1/$2/$3';
//$route['404_override'] = 'pws/main/logout';


/* End of file routes.php */
/* Location: ./application/config/routes.php */