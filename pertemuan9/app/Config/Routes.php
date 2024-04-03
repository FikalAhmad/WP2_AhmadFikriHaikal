<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Autentifikasi::index');
$routes->get('/autentifikasi/blok', 'Autentifikasi::blok');
$routes->get('/autentifikasi/gagal', 'Autentifikasi::gagal');
$routes->get('/registrasi', 'Autentifikasi::registrasi');
$routes->get('/user', 'User::index');
$routes->get('/user/ubahprofil', 'User::ubahProfil');
$routes->get('/admin', 'Admin::index');

$routes->post('/autentifikasi', 'Autentifikasi::index');
$routes->post('/user/ubahprofil', 'User::ubahProfil');
$routes->post('/registrasi', 'Autentifikasi::registrasi');
