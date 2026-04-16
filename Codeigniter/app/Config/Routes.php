<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// ⚠️ IMPORTANT: Make sure this exists
$routes->setAutoRoute(true);

// ===============================
// 1. DEFAULT ROUTE
// ===============================
$routes->get('/', 'AuthController::login');


// ===============================
// 2. AUTHENTICATION ROUTES
// ===============================
$routes->get('login', 'AuthController::login');
$routes->post('auth/loginProcess', 'AuthController::loginProcess');
$routes->get('logout', 'AuthController::logout');

// Registration
$routes->get('register', 'AuthController::register');
$routes->post('auth/store', 'AuthController::store');


// ===============================
// 3. TASK MANAGEMENT ROUTES
// ===============================
$routes->get('tasks', 'TaskController::index');
$routes->post('tasks/create', 'TaskController::create');
$routes->get('tasks/edit/(:num)', 'TaskController::edit/$1');
$routes->post('tasks/update/(:num)', 'TaskController::update/$1');
$routes->get('tasks/delete/(:num)', 'TaskController::delete/$1');