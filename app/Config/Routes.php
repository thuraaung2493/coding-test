<?php

use App\Controllers\Employee;
use App\Controllers\Login;
use App\Controllers\Register;
use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', [Employee::class, 'index'], ['filter' => 'auth']);
$routes->post('/upload', [Employee::class, 'upload'], ['filter' => 'auth']);
$routes->get('/export', [Employee::class, 'export'], ['filter' => 'auth']);
$routes->post('employees/(:segment)/delete', [Employee::class, 'destroy']);

$routes->get('register', [Register::class, 'index']);
$routes->post('register', [Register::class, 'store']);

$routes->get('login', [Login::class, 'index']);
$routes->post('login', [Login::class, 'store']);
$routes->post('logout', [Login::class, 'logout']);
