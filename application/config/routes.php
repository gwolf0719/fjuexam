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


// $route['voice'] = 'voice';
$route['voice/api/(:any)'] = 'voices/api/$1';
$route['voice/index'] = 'voices/intro/index';
$route['voice/a'] = 'voices/import/index';
$route['voice/a/(:any)'] = 'voices/import/$1';
$route['voice/b'] = 'voices/test_duty/index';
$route['voice/b/duty/(:any)'] = 'voices/test_duty/duty/$1';
$route['voice/b/duty_b5'] = 'voices/test_duty/duty_b5';
$route['voice/c'] = 'voices/test_assign/index';
$route['voice/c/assign/(:any)'] = 'voices/test_assign/assign/$1';
$route['voice/c/assign_c4'] = 'voices/test_assign/assign_c4';
$route['voice/d'] = 'voices/appoint/index';
$route['voice/d/(:any)'] = 'voices/appoint/$1';
$route['voice/e'] = 'voices/test_form/index';
$route['voice/e/form/(:any)'] = 'voices/test_form/$1';






$route['voice/f'] = 'voices/test_setting/index';
$route['voice/f/(:any)'] = 'voices/test_setting/$1';
// $route['voice/a/(:any)'] = 'Voice/import/$1';

$route['(:any)'] = 'welcome/$1';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

