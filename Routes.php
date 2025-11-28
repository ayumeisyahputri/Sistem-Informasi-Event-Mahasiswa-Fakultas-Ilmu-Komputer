<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->group('admin/event', function($routes){
    $routes->get('/', 'EventController::index');
    $routes->get('form', 'EventController::form');
    $routes->get('form/(:num)', 'EventController::form/$1');
    $routes->post('save', 'EventController::save');
    $routes->get('delete/(:num)', 'EventController::delete/$1');
});
