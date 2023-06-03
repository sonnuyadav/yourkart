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
|	http://codeigniter.com/user_guide/general/routing.html
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
$route['default_controller'] = 'index/index';


//////////////////  For Static Pages //////////////

$route['page/(:any)'] = 'index/page/$1';
$route['contactus'] = 'index/contact';
$route['contact_form'] = 'index/contact_form';
$route['contest'] = 'index/contest';
$route['contest_submit'] = 'index/contest_submit';
$route['signupcreate'] = 'index/signupcreate';
$route['newletter_unsubscribe/(:any)'] = 'index/newletter_unsubscribe/$1';

////////////////////////////////////////////////////


$route['shop/category/(:any)'] = 'products/categoryListing/$1';
$route['brand/(:any)'] = 'products/BrandListing/$1';
$route['product/(:any)'] = 'products/productsDetails/$1';
$route['brand/(:any)/tag/(:any)'] = 'products/BrandListing/$1/$2';

$route['searchlist'] = 'products/searchList';
$route['search'] = 'products/searchListing/';

$route['basket/(\d+)'] = 'basket/addtocart/$1';
$route['basket/'] = 'basket/index/$1';
$route['basket/orderconfirmation/'] = 'basket/orderconfirmation';
$route['login'] = 'customer/login/';
$route['user/dashboard'] = 'customer/dashboard';
$route['user/update_profile'] = 'customer/profileupdate';
$route['user/change_password'] = 'customer/passwordupdate';
$route['thankyou'] = 'common/thankyou/';
$route['order/response'] = 'basket/orderresponse/';

$route['combo/'] = 'combo/';
$route['combo/(:any)'] = 'combo/single/$1';

$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['admin'] = 'admin/dashboard';
$route['admin/prefs/interfaces/(:any)'] = 'admin/prefs/interfaces/$1';

