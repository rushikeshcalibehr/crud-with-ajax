<?php
namespace Config;
use CodeIgniter\Router\RouteCollection;
use Config\Services;
 $routes = Services::routes();
/**
 * 
 */
// $routes->resource('employee');
// $routes->resource('employee', ['placeholder' => '(:num)']);
$routes->get('employee', 'Employee::index');
$routes->put('employee/(:num)', 'Employee::update/$1');
$routes->get('employee/(:num)', 'Employee::show/$1');
$routes->delete('employee/(:num)', 'Employee::delete/$1');
$routes->post('employee', 'Employee::create');