<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Matakuliah::index');
$routes->post('/cetak', 'Matakuliah::cetak');
