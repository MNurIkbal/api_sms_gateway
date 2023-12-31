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
$route['default_controller'] = 'auth';

//auth
$route['login'] = 'auth';
$route['logout'] = 'auth/logout';

//admin
$route['admin'] = 'admin/home';
$route['kelas'] = 'admin/kelas';
$route['mapel'] = 'admin/mapel';
$route['data-guru'] = 'admin/DataGuru';
$route['add-guru'] = 'admin/DataGuru/addGuru';
$route['data-siswa'] = 'admin/DataSiswa';
$route['edit-siswa/(:any)'] = 'admin/DataSiswa/editSiswa/$1';
$route['edit-guru/(:any)'] = 'admin/DataGuru/editGuru/$1';
$route['detail-guru/(:any)'] = 'admin/DataGuru/detailGuru/$1';
$route['edit-Kelas/(:any)'] = 'admin/Kelas/editKelas/$1';
$route['add-siswa'] = 'admin/DataSiswa/addSiswa';
$route['detail-siswa/(:any)'] = 'admin/DataSiswa/detailSiswa';
$route['data-rekap'] = 'admin/DataRekap';
$route['cetak_admin/(:any)/(:any)/(:any)'] = 'admin/DataRekap/cetak_admin';

//guru
$route['guru'] = 'guru/home';
$route['gr/absensi'] = 'guru/absensi';
$route['gr/data-siswa'] = 'guru/DataSiswa';
$route['gr/add-siswa'] = 'guru/DataSiswa/addSiswa';
$route['gr/data-rekap'] = 'guru/DataRekap';
$route['gr/cetak/(:any)/(:any)/(:any)'] = 'guru/DataRekap/cetak';
$route['gr/pesan'] = 'guru/pesan';


//cetakRekap
$route['cetak-rekap'] = 'CetakRekap';

$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
