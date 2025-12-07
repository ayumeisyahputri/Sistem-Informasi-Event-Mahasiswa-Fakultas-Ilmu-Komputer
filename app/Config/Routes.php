<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;
use CodeIgniter\Router\RouteCollection;
use Config\Services;

/**
 * @var RouteCollection $routes
 */
$routes = Services::routes();

// AUTO ROUTE (bisa hidup / mati)
$routes->setAutoRoute(true);

/*
|--------------------------------------------------------------------------
| Default Route
|--------------------------------------------------------------------------
*/

$routes->get('/', 'Auth::login');
$routes->get('/login', 'Auth::login');
$routes->post('/loginProcess', 'Auth::loginProcess');
$routes->get('/logout', 'Auth::logout');

/*
|--------------------------------------------------------------------------
| Protected Routes (Login required)
|--------------------------------------------------------------------------
*/

$routes->group('', ['filter' => 'authGuard'], function($routes){

    $routes->get('/dashboard', 'Dashboard::index');

    // EVENT
    $routes->get('/event', 'EventController::index');
    $routes->get('/event/detail/(:num)', 'EventController::detail/$1');
    $routes->get('/event/create', 'EventController::create');
    $routes->post('/event/store', 'EventController::store');
    $routes->get('/event/edit/(:num)', 'EventController::edit/$1');
    $routes->post('/event/update/(:num)', 'EventController::update/$1');
    $routes->get('/event/delete/(:num)', 'EventController::delete/$1');

    // Mahasiswa daftar event
    $routes->get('/event/daftar', 'EventController::listMahasiswa');
    $routes->get('/event/info/(:num)', 'EventController::info/$1');

    // PENDAFTARAN
    $routes->get('/pendaftaran', 'PendaftaranController::index');
    $routes->get('/pendaftaran/create/(:num)', 'PendaftaranController::create/$1');
    $routes->post('/pendaftaran/store', 'PendaftaranController::store');
    $routes->get('/pendaftaran/edit/(:num)', 'PendaftaranController::edit/$1');
    $routes->post('/pendaftaran/update/(:num)', 'PendaftaranController::update/$1');
    $routes->get('/pendaftaran/delete/(:num)', 'PendaftaranController::delete/$1');

    // DOWNLOAD FILE
    $routes->get('/pendaftaran/download/(:num)', 'PendaftaranController::download/$1');

    // BUKTI PENDAFTARAN
    $routes->get('/pendaftaran/bukti/(:num)', 'PendaftaranController::bukti/$1');

    // NOTIFIKASI
    $routes->get('/notifikasi', 'NotifikasiController::index');
    $routes->get('/notifikasi/delete/(:num)', 'NotifikasiController::delete/$1');

});

/*
|--------------------------------------------------------------------------
| Additional Routing
|--------------------------------------------------------------------------
*/

if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}
