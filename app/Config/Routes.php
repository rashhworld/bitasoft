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
$routes->setDefaultController('PartnerControl');
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
// =================================================================================
$routes->add('admin/auth', 'AdminControl::showAdminAuth');
$routes->add('admin/logout', 'AdminControl::logout');

$routes->group("admin", ['filter' => 'AdminGuard'], function ($routes) {
    $routes->add('/', 'AdminControl::viewDashboard');

    $routes->add('catagory', 'AdminControl::viewCatagory');

    $routes->add('material', 'AdminControl::viewAllMaterial');
    $routes->add('material/add', 'AdminControl::viewAddMaterial');
    $routes->add('material/arrange', 'AdminControl::arrangeMaterialPos');
    $routes->add('material/read/(:any)', 'AdminControl::readMaterial/$1');
    $routes->add('material/update/(:any)', 'AdminControl::viewUpdateMaterial/$1');

    $routes->add('blog', 'AdminControl::viewAllBlogpost');
    $routes->add('blog/add', 'AdminControl::viewAddBlogpost');
    $routes->add('blog/read/(:any)', 'AdminControl::readBlogpost/$1');
    $routes->add('blog/update/(:any)', 'AdminControl::viewUpdateBlogpost/$1');

    $routes->add('search/(:any)/(:any)', 'AdminControl::searchArticle/$1/$2');
});
// =================================================================================

// =================================================================================
$routes->add('/', 'UserControl::viewDashboard');
$routes->add('blog', 'UserControl::viewBlogDashboard');

$routes->add('material/(:any)/(:any)/(:any)', 'UserControl::readMaterial/$1/$2/$3');
$routes->add('blog/(:any)', 'UserControl::readBlogpost/$1');
$routes->add('search/(:any)', 'UserControl::searchArticle/$1');
$routes->add('contact/(:any)/(:any)/(:any)', 'UserControl::contactAdmin/$1/$2/$3');
// =================================================================================

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
