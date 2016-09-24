<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
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

$route['default_controller'] = 'client/home';
$route['404_override'] = 'client/error_404';

$route['acp_admin'] = 'admin/home';
$route['acp_admin/(:any)?'] = 'admin/$1';

$route['lien-he.html'] = 'client/html/contact';

$route["tin-tuc.html"] = "client/news/index";
$route["tin-tuc-trang-([\d]+).html"] = "client/news/index//$1";
$route['tin-tuc/danh-muc-([\w\-]+)-trang-([\d]+).html'] = 'client/news/index/$1/$2';
$route['tin-tuc/danh-muc-([\w\-]+).html'] = 'client/news/index/$1';
$route['tin-tuc/([\w\-]+)/([\w\-]+).html'] = 'client/news/detail/$1/$2';
$route['tin-tuc/([\w\-]+).html'] = 'client/news/detail//$1';

$route["thiet-ke.html"] = "client/thietke/index";
$route["thiet-ke-trang-([\d]+).html"] = "client/thietke/index//$1";
$route['thiet-ke/([\w\-]+)-trang-([\d]+).html'] = 'client/thietke/index/$1/$2';
$route['thiet-ke/([\w\-]+).html'] = 'client/thietke/seoLink/$1';
$route['thiet-ke/([\w\-]+)/([\w\-]+).html'] = 'client/thietke/detail/$1/$2';

$route["noi-that.html"] = "client/spnoithat/index";
$route["noi-that-trang-([\d]+).html"] = "client/spnoithat/index//$1";
$route['noi-that/([\w\-]+)-trang-([\d]+).html'] = 'client/spnoithat/index/$1/$2';
$route['noi-that/([\w\-]+).html'] = 'client/spnoithat/seoLink/$1';
$route['noi-that/([\w\-]+)/([\w\-]+).html'] = 'client/spnoithat/detail/$1/$2';

$route['tim-kiem.html'] = 'client/search/index';
$route["tim-kiem-trang-([\d]+).html"] = "client/search/index/$1";

$route['admin/(:any)?'] = 'client/error_404';

/* End of file routes.php */
/* Location: ./application/config/routes.php */
