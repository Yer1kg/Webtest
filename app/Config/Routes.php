<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (is_file(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

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
 $routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index');

// Rutas para usuarios
$routes->match(['get', 'post'], 'registrar', 'User::register', ['filter' => 'puede_no_autorizado']);
$routes->match(['get', 'post'], 'login', 'User::login', ['filter' => 'puede_no_autorizado']);
$routes->get('perfil', 'User::mostrarPerfil', ['filter' => 'autorizado']);
$routes->get('usuarios', 'User::listadoCompleto', ['filter' => 'adminlogueado']);
$routes->get('usuarios/ver/(:num)', 'User::getVer/$1');
$routes->get('usuarios/editar/(:num)', 'User::getEditar/$1');
$routes->post('usuarios/editar/(:num)', 'User::postEditar/$1');
$routes->get('usuarios/borrarusuarios/(:num)', 'User::getBorrarusuario/$1');

$routes->get('salir', 'User::abandonarsesion');

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
