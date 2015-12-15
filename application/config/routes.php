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
//$route['admin'] = 'admin';
$route['logout'] = 'home/logout';
$route['login'] = 'login';
$route['remap_threat/(:any)'] = 'home/remap_threat/$1';
$route['edit_threat_definition/(:any)'] = 'home/edit_threat_definition/$1';
$route['add_threat_definition'] = 'home/add_threat_definition';
//$route['virus/(:any)'] = 'home/virus/$1';
$route['getSummary/(:any)'] = 'home/getSummary/$1';
$route['getThreatsByAlias/(:any)'] = 'home/getThreatsByAlias/$1';
$route['getAssignmentsByThreat/(:any)'] = 'home/getAssignmentsByThreat/$1';
$route['viewrelated/(:any)'] = 'home/viewrelated/$1';
$route['view_by_id/(:any)'] = 'home/view_by_id/$1';
$route['view/(:any)'] = 'home/view/$1';
$route['default_controller'] = "home";

$route['404_override'] = '';


/* End of file routes.php */
/* Location: ./application/config/routes.php */