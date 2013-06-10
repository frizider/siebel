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

$route['default_controller'] = "contact";
$route['404_override'] = '';
$route['diamond/:any'] = "diamond";
$route['contacts'] = "contact";
$route['contacts/edit/:any'] = "contact/edit";
$route['contacts/customer'] = "contact/customer";
$route['contacts/customer/:any'] = "contact/customer";
$route['contacts/delete/:any'] = "contact/delete";
$route['comments/customer/:any'] = "comments";
$route['comments/categories/:any'] = "comments/categories";
$route['newcustomer/:any'] = "newcustomer";
$route['auth/edit_permission/:any'] = "auth/edit_permission";
$route['deliverydays/customer/:any'] = "deliverydays/customer";
$route['deliverydays/edit/:any'] = "deliverydays/edit";
$route['formulas/:any'] = "formulas";
$route['lme/:any'] = "lme";


/* End of file routes.php */
/* Location: ./application/config/routes.php */