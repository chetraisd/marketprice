<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
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

$route['default_controller'] = "home";
$route['404_override'] = '';
//$route['loc'] = 'setup/clocation';

$route['buyticket'] = 'interface/cinterface';
$route['dash'] = 'dashboard/dashboard';
$route['ct']='invoice/c_report_checking_ticketing';
$route['gaa']='report/c_agency_approval';
$route['tt']='setup/cticket_type';
$route['crr']='setup/ccurrency';
$route['lc']='setup/clocation';
$route['park']='setup/cpark';
$route['payt']='setup/cpayment_type';
$route['newt']='interface/cinterface';
$route['ent']='setup/cgate';
$route['tst']='setup/ccounter';
$route['url']='setting/user';
$route['stp']='setting/page';
$route['str']='setting/role';
$route['stra']='setting/permission';
$route['up']='setting/userprofile';
$route['rl']='report/c_report_receipt';
$route['dts']='report/c_report_sale';
$route['ga']='setup/cagency';
$route['pl']='setup/cprice_list';
$route['pkl']='setup/cpackage';
$route['ts']='setup/c_setup_prefix';
$route['gta']='invoice/cagency_approval';
$route['cl']='setup/ccountry';
$route['gict_clear']='systems/sys/cleartransaction';
$route['cts']='setup/ctran_turnstile';
/* End of file routes.php */
/* Location: ./application/config/routes.php */