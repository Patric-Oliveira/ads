<?php

$routes->group('dashboard', ['namespace' => 'App\Controllers\Dashboard', 'filter' => 'auth:web'], function ($routes) {

    $routes->get('/', 'DashboardController::index', ['filter' => 'verified', 'as' => 'dashboard']);

    // User ADS
    /**
     * @todo criar filtro subscription
     */
    $routes->group('adverts', ['namespace' => 'App\Controllers\Dashboard'], function ($routes) {

        $routes->get('my', 'AdvertsUserController::index', ['as' => 'my.adverts']);
    });
});
