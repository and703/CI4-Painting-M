<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Worker');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/reprint', 'Komik::index'); 
$routes->get('/komik/create', 'Komik::create');
$routes->get('/komik/edit/(:segment)', 'Komik::edit/$1');
$routes->delete('/komik/(:num)', 'Komik::delete/$1');
$routes->get('/re_print/(:any)', 'Komik::detail/$1');
$routes->get('/print/(:any)', 'Komik::detail2/$1');
$routes->get('/p_park/(:any)', 'Komik::detail3/$1');
$routes->get('/p_man/(:any)', 'Komik::detail4/$1');
$routes->get('/reprint/update/(:any)', 'Komik::update/$1');
$routes->get('/p_reb/(:any)', 'Komik::reboaiaca/$1');
//$routes->get('report', 'Report::index');
//$routes->post('data_tables', 'Report::data_tables');
$routes->get('chart', 'Chart::index');
//$routes->get('report_parking', 'Report_parking::index');
//$routes->post('data_tables', 'Report_parking::data_tables');

$routes->get('api_app/jumlah', 'Worker::api_jumlah');
$routes->get('api_app/result', 'Worker::api_result');
$routes->get('r_status', 'R_status::index');
$routes->get('rku', function(){
	echo "Test";
});

/*
$routes->post('r_status/data_tables', function(){
	echo "Post";
});
*/
$routes->post('r_status/data_tables', 'R_status::data_tables');

$routes->get('report_paint', 'Report_paint::index');
$routes->post('data_tables', 'Report_paint::data_tables');
$routes->get('report_paint_out', 'Report_paint_out::index');
$routes->post('data_tables_out', 'Report_paint_out::data_tables');



$routes->get('/', 'Worker::index');
$routes->get('worker', 'Worker::index');
$routes->get('parking', 'Worker::MM_log');
$routes->get('park_view', 'Worker::park_view');
$routes->get('park_cure', 'Worker::park_cure');
$routes->get('stock', 'Worker::stock');
$routes->get('t_stock', 'Worker::t_stock');
$routes->get('p_show', 'Worker::park_Show');
$routes->get('mch', 'Worker::mch_log');
$routes->get('cure', 'Worker::cure');
$routes->get('cure_mch', 'Worker::cure_mch');

// Setting Routes
$routes->get('users/userRoleAccess', 'Users::userRoleAccess');
$routes->post('users/createRole', 'Users::createRole');
$routes->post('users/updateRole', 'Users::updateRole');
$routes->delete('users/deleteRole', 'Users::deleteRole');
$routes->post('users/createMenuCategory', 'Users::createMenuCategory');
$routes->post('users/createMenu', 'Users::createMenu');
$routes->post('users/createSubMenu', 'Users::createSubMenu');
$routes->post('users/createUser', 'Users::createUser');
$routes->post('users/updateUser', 'Users::updateUser');
$routes->delete('users/deleteUser', 'Users::deleteUser');
$routes->post('users/changeMenuPermission', 'Users::changeMenuPermission');
$routes->post('users/changeMenuCategoryPermission', 'Users::changeMenuCategoryPermission');
$routes->post('users/changeSubMenuPermission', 'Users::changeSubMenuPermission');


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
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
