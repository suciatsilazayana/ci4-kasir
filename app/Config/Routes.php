<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

$routes->get('/register', 'Home::register');
$routes->post('/insert_user', 'Home::insert_user');
$routes->post('/auth', 'Home::auth');
$routes->post('/logout', 'Home::logout');
$routes->get('/halaman_tambahuser', 'Home::halaman_tambahuser');
$routes->post('/add_user', 'Home::add_user');
