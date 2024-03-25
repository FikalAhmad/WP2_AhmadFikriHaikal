<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Autentifikasi::index');
$routes->post('/autentifikasi', 'Autentifikasi::index');
$routes->get('/admin', 'Admin::index');
