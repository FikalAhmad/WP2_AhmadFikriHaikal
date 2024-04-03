<?php

use CodeIgnitzer\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Latihan1::index');
$routes->get('/penjumlahan/(:num)/(:num)', "Latihan1::penjumlahan/$1/$2");
