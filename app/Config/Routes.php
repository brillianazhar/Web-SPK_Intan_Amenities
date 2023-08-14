<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
// $routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
// $routes->get('/', 'Home::index');
$routes->get('/', 'Auth::index', ['filter' => 'redirectIfAuthenticated']);
$routes->post('/', 'Auth::index', ['filter' => 'redirectIfAuthenticated']);
$routes->post('/signup', 'Auth::signup');
$routes->post('/login', 'Auth::login');
$routes->get('/logout', 'Auth::logout', ['filter' => 'authenticate']);
$routes->get('/user_management', 'Admin::index', ['filter' => 'authenticate']);
$routes->post('/user_management', 'Admin::index', ['filter' => 'authenticate']);
$routes->get('/user', 'User::index', ['filter' => 'authenticate']);
$routes->post('/user', 'User::index', ['filter' => 'authenticate']);
$routes->get('/data_alternatif', 'User::data_alternatif', ['filter' => 'authenticate']);
$routes->post('/data_alternatif', 'User::data_alternatif', ['filter' => 'authenticate']);
$routes->get('/data_kriteria', 'User::data_kriteria', ['filter' => 'authenticate']);
$routes->post('/data_kriteria', 'User::data_kriteria', ['filter' => 'authenticate']);
$routes->get('/hasil', 'User::hasil', ['filter' => 'authenticate']);
$routes->get('/tambah_kriteria', 'User::tambah_kriteria_index', ['filter' => 'authenticate']);
$routes->post('/edit_kriteria/(:segment)', 'User::edit_kriteria_index/$1', ['filter' => 'authenticate']);
$routes->post('/addKriteria', 'User::addKriteria', ['filter' => 'authenticate']);
$routes->get('/tambah_alternatif', 'User::tambah_alternatif_index', ['filter' => 'authenticate']);
$routes->post('/edit_alternatif/(:segment)', 'User::edit_alternatif_index/$1', ['filter' => 'authenticate']);
$routes->post('/addAlternatif', 'User::addAlternatif', ['filter' => 'authenticate']);
$routes->get('/gagalHasil', 'User::gagalHasil', ['filter' => 'authenticate']);
$routes->get('/data_sub_kriteria', 'User::data_sub_kriteria', ['filter' => 'authenticate']);
$routes->post('/data_sub_kriteria', 'User::data_sub_kriteria', ['filter' => 'authenticate']);
$routes->get('/tambah_sub_kriteria', 'User::tambah_sub_kriteria_index', ['filter' => 'authenticate']);
$routes->post('/edit_sub_kriteria/(:segment)', 'User::edit_sub_kriteria_index/$1', ['filter' => 'authenticate']);
$routes->post('/addSubKriteria', 'User::addSubKriteria', ['filter' => 'authenticate']);

$routes->post('/cekEmail', 'Auth::cekEmail');
$routes->post('/cekNamaKriteria', 'User::cekNamaKriteria');
$routes->post('/cekNamaEditKriteria/(:segment)', 'User::cekNamaEditKriteria/$1');
$routes->post('/cekNamaSubKriteria', 'User::cekNamaSubKriteria');
$routes->post('/cekNamaEditSubKriteria/(:segment)', 'User::cekNamaEditSubKriteria/$1');
$routes->post('/cekNamaAlternatif', 'User::cekNamaAlternatif');
$routes->post('/cekKodeAlternatif', 'User::cekKodeAlternatif');
$routes->post('/cekNamaEditAlternatif/(:segment)', 'User::cekNamaEditAlternatif/$1');
$routes->post('/cekKodeEditAlternatif/(:segment)', 'User::cekKodeEditAlternatif/$1');

$routes->post('/confirmUser/(:num)', 'Admin::confirmUser/$1');
$routes->delete('/deleteUser/(:num)', 'Admin::deleteUser/$1');

$routes->post('/editKriteria/(:num)', 'User::editKriteria/$1');
$routes->delete('/deleteKriteria/(:num)', 'User::deleteKriteria/$1');
$routes->post('/editSubKriteria/(:num)', 'User::editSubKriteria/$1');
$routes->delete('/deleteSubKriteria/(:num)', 'User::deleteSubKriteria/$1');
$routes->post('/editAlternatif/(:num)', 'User::editAlternatif/$1');
$routes->delete('/deleteAlternatif/(:num)', 'User::deleteAlternatif/$1');

$routes->get('/export_pdf', 'User::exportPDF', ['filter' => 'authenticate']);
$routes->get('/export_pdf2', 'User::exportPDF2', ['filter' => 'authenticate']);

/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
