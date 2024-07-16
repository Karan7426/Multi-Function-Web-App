<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
 

 
 
 
// $routes->get('dashboard', 'Dashboard::index', ['filter' => 'auth']);


 
$routes->get('/', 'User::index');
$routes->get('/create/', 'User::create');
$routes->post('/create/', 'User::create');
 
$routes->get('/update/(:num)/', 'User::update/$1');
$routes->post('/update/(:num)/', 'User::update/$1');
$routes->put('/update/(:num)/', 'User::update/$1');
$routes->delete('/delete/(:num)', 'User::delete/$1');
$routes->get('/exportCSV/', 'User::exportCSV');

$routes->get('/calculate-distance/', 'Functions::calculateDistanceExample');
$routes->get('/audio-length/(:any)', 'Functions::getAudioLengthExample/$1');

 
 
 
 
 


