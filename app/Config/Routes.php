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
$routes->resource("apirestcodeiginiter4");

$routes->get("personas","PersonasController::index");
$routes->get("/personas/(:any)","PersonasController::indexXid/$1");
$routes->post("personas","PersonasController::insertarPersona");

//categorias

$routes->get("/categorias","CategoriasController::index");
$routes->get("/categorias/(:any)","CategoriasController::show/$1");
$routes->post("/categorias","CategoriasController::insertCategoria");
$routes->delete("/categorias/(:any)","CategoriasController::deleteCategoria/$1");
$routes->put("categorias/(:any)","CategoriasController::updateCategoria/$1");

//usuarios

$routes->get("/usuarios","UsuariosController::index");
$routes->get("/usuarios/(:any)","UsuariosController::idUser/$1");
$routes->post("/usuarios","UsuariosController::insertUsuarios");
$routes->put("/usuarios/(:any)","UsuariosController::updateUsuario/$1");

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
