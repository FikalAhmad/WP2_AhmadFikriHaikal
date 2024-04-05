<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Autentifikasi::index');
$routes->get('/autentifikasi/blok', 'Autentifikasi::blok');
$routes->get('/autentifikasi/gagal', 'Autentifikasi::gagal');
$routes->get('/autentifikasi/registrasi', 'Autentifikasi::registrasi');
$routes->get('/user', 'User::index');
$routes->get('/user/ubahprofil', 'User::ubahProfil');
$routes->get('/admin', 'Admin::index');
$routes->get('/autentifikasi/logout', 'Autentifikasi::logout');
$routes->get('/user/anggota', 'User::anggota');
$routes->get('/buku', 'Buku::index');
$routes->get('/buku/kategori', 'Buku::kategori');

$routes->post('/autentifikasi', 'Autentifikasi::index');
$routes->post('/user/ubahprofil', 'User::ubahProfil');
$routes->post('/autentifikasi/registrasi', 'Autentifikasi::registrasi');
$routes->post('/autentifikasi/logout', 'Autentifikasi::logout');
