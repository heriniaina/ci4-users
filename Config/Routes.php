<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

 $routes->group('admin/users', ['namespace' => '\Solaitra\Users\Controllers', 'filter' => 'permission:users.manage'], function($routes) {
    $routes->get('/', 'UserController::index');
    $routes->match(['POST', 'GET'], 'create', 'UserController::create');
    $routes->match(['POST', 'GET'] , 'edit/(:num)', 'UserController::edit/$1');
    $routes->match(['POST', 'GET'] , 'delete/(:num)', 'UserController::delete/$1');
});
