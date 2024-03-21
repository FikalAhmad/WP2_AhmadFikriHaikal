<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'DataSiswa::index');
$routes->post('/cetak', 'DataSiswa::cetak');
