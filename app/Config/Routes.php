<?php

namespace Config;

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes = Services::routes();

// Load default CodeIgniter routes.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
|--------------------------------------------------------------------------
| Public Pages
|--------------------------------------------------------------------------
*/
$routes->get('/', 'PageController::home');
$routes->get('about', 'PageController::about');

/*
|--------------------------------------------------------------------------
| Login and Logout
|--------------------------------------------------------------------------
*/
$routes->match(['get', 'post'], 'login', 'AuthController::login');
$routes->post('logout', 'AuthController::logout');

/*
|--------------------------------------------------------------------------
| Protected Pages
|--------------------------------------------------------------------------
*/
$routes->get('profile', 'PageController::profile', [
    'filter' => 'auth',
]);

/*
|--------------------------------------------------------------------------
| Task Management
|--------------------------------------------------------------------------
*/
$routes->get('tasks', 'TaskController::index', [
    'filter' => 'auth',
]);

$routes->get('tasks/new', 'TaskController::create', [
    'filter' => 'auth',
]);

$routes->post('tasks', 'TaskController::store', [
    'filter' => 'auth',
]);

$routes->get('tasks/edit/(:num)', 'TaskController::edit/$1', [
    'filter' => 'auth',
]);

$routes->post('tasks/update/(:num)', 'TaskController::update/$1', [
    'filter' => 'auth',
]);

$routes->post('tasks/archive/(:num)', 'TaskController::archive/$1', [
    'filter' => 'auth',
]);