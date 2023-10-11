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
$routes->post('/upload/update', [Employee::class, 'updateBulk'], ['filter' => 'auth']);
$routes->get('/export', [Employee::class, 'export'], ['filter' => 'auth']);
$routes->get('/employees/(:segment)/edit', [Employee::class, 'edit'], ['filter' => 'auth']);
$routes->post('/employees/(:segment)', [Employee::class, 'update'], ['filter' => 'auth']);
$routes->post('/employees/(:segment)/delete', [Employee::class, 'destroy'], ['filter' => 'auth']);

$routes->get('register', [Register::class, 'index']);
$routes->post('register', [Register::class, 'store']);

$routes->get('login', [Login::class, 'index']);
$routes->post('login', [Login::class, 'store']);
$routes->post('logout', [Login::class, 'logout', ['filter' => 'auth']]);
