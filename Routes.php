// Admin event
$routes->group('admin', ['filter' => 'adminGuard'], function($routes) {
    $routes->get('event', 'EventController::index');
    $routes->get('event/create', 'EventController::create');
    $routes->post('event/store', 'EventController::store');
    $routes->get('event/edit/(:num)', 'EventController::edit/$1');
    $routes->post('event/update/(:num)', 'EventController::update/$1');
    $routes->get('event/delete/(:num)', 'EventController::delete/$1');
    $routes->get('event/riwayat', 'EventController::riwayat');
});
