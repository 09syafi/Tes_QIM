<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');


$routes->get('/', 'Home::index');

// Dosen
$routes->get('/dosen', 'Dosen::index');
$routes->get('/dosen/create', 'Dosen::create');
$routes->post('/dosen/store', 'Dosen::store');
$routes->get('/dosen/edit/(:num)', 'Dosen::edit/$1');
$routes->post('/dosen/update/(:num)', 'Dosen::update/$1');
$routes->get('/dosen/delete/(:num)', 'Dosen::delete/$1');
$routes->get('/dosen/mengajar/(:num)', 'Dosen::mengajar/$1');
$routes->post('/dosen/mengajar/(:num)/tambah', 'Dosen::tambahMengajar/$1');
$routes->get('/dosen/mengajar/(:num)/hapus/(:num)', 'Dosen::hapusMengajar/$1/$2');

// Mata Kuliah
$routes->get('/mata-kuliah', 'MataKuliah::index');
$routes->get('/mata-kuliah/create', 'MataKuliah::create');
$routes->post('/mata-kuliah/store', 'MataKuliah::store');
$routes->get('/mata-kuliah/edit/(:num)', 'MataKuliah::edit/$1');
$routes->post('/mata-kuliah/update/(:num)', 'MataKuliah::update/$1');
$routes->get('/mata-kuliah/delete/(:num)', 'MataKuliah::delete/$1');
