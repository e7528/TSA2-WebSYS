<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */
$routes->setAutoRoute(false);
$routes->get('/', 'Welcome::index');
$routes->get('tasks', 'Tasks::index');
$routes->get('profile', 'Profile::index');
$routes->get('about', 'About::index');
$routes->get('login', 'Auth::login');
$routes->post('login', 'Auth::authenticate');

$routes->group('', ['filter' => 'auth'], static function (RouteCollection $routes): void {
    $routes->post('logout', 'Auth::logout');
    $routes->get('tasks/new', 'Tasks::new');
    $routes->post('tasks', 'Tasks::create');
    $routes->get('tasks/(:num)/edit', 'Tasks::edit/$1');
    $routes->post('tasks/(:num)', 'Tasks::update/$1');
    $routes->post('tasks/(:num)/archive', 'Tasks::archive/$1');
});
