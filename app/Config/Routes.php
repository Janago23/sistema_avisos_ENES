<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// Ruta principal, redirige al inicio de sesión
$routes->get('/', 'SigninController::index');

// Ruta para el registro de usuario
$routes->get('/signup', 'SignupController::index');
$routes->match(['get', 'post'], 'SignupController/store', 'SignupController::store');

// Ruta para el inicio de sesión
$routes->match(['get', 'post'], 'SigninController/loginAuth', 'SigninController::loginAuth');

// Ruta para el perfil (protegida con filtro)
$routes->get('/profile', 'ProfileController::index', ['filter' => 'authGuard']);

//ruta para ir al dashboard
$routes->get('/dashboard', 'ProfileController::index');

//ruta para cierre de sesión
$routes->get('/logout', 'SigninController::logout');


 