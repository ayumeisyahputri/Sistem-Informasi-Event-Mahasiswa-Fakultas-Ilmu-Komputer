<?php

$routes->get('/', 'Auth::login');
$routes->get('/login', 'Auth::login');
$routes->post('/loginProcess', 'Auth::loginProcess');
$routes->get('/logout', 'Auth::logout');

/*
 * Protected routes (requires login)
 */
$routes->group('', ['filter' => 'authGuard'], function($routes){

    $routes->get('/dashboard', 'Dashboard::index');

    // Event (admin actions guarded in controller or use AdminGuard)
    $routes->get('/event', 'EventController::index');
    $routes->get('/event/detail/(:num)', 'EventController::detail/$1');
    $routes->get('/event/create', 'EventController::create');
    $routes->post('/event/store', 'EventController::store');
    $routes->get('/event/edit/(:num)', 'EventController::edit/$1');
    $routes->post('/event/update/(:num)', 'EventController::update/$1');
    $routes->get('/event/delete/(:num)', 'EventController::delete/$1');

    // Mahasiswa
    $routes->get('/mahasiswa', 'MahasiswaController::index');
    $routes->get('/mahasiswa/create', 'MahasiswaController::create');
    $routes->post('/mahasiswa/store', 'MahasiswaController::store');
    $routes->get('/mahasiswa/edit/(:num)', 'MahasiswaController::edit/$1');
    $routes->post('/mahasiswa/update/(:num)', 'MahasiswaController::update/$1');
    $routes->get('/mahasiswa/delete/(:num)', 'MahasiswaController::delete/$1');

    // Pendaftaran
    $routes->get('/pendaftaran', 'PendaftaranController::index');
    $routes->get('/pendaftaran/create/(:num)', 'PendaftaranController::create/$1'); // daftar ke event
    $routes->post('/pendaftaran/store', 'PendaftaranController::store');
    $routes->get('/pendaftaran/edit/(:num)', 'PendaftaranController::edit/$1');
    $routes->post('/pendaftaran/update/(:num)', 'PendaftaranController::update/$1');
    $routes->get('/pendaftaran/delete/(:num)', 'PendaftaranController::delete/$1');

    // Notifikasi
    $routes->get('/notifikasi', 'NotifikasiController::index');
    $routes->get('/notifikasi/delete/(:num)', 'NotifikasiController::delete/$1');

});
