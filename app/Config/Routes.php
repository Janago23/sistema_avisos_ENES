<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// Ruta principal, redirige al inicio de sesión
$routes->get('/', 'SigninController::index');

// Ruta para el registro de usuario
$routes->get('/signup', 'SignupController::index');
$routes->match(['get', 'post'], '/signup/store', 'SignupController::store');

// Ruta para el inicio de sesión
$routes->match(['get', 'post'], '/signin/loginAuth', 'SigninController::loginAuth');

// Ruta para ir al dashboard
$routes->get('/dashboard', 'ProfileController::index');

// Ruta para cierre de sesión
$routes->get('/logout', 'SigninController::logout');

// Publicaciones
$routes->group('publicaciones', function($routes) {
    $routes->get('/', 'PublicacionController::index');
    $routes->get('agregar', 'PublicacionController::agregar');
    $routes->post('store', 'PublicacionController::agregar');
    $routes->get('habilitar/(:num)', 'PublicacionController::habilitar/$1');
    $routes->get('deshabilitar/(:num)', 'PublicacionController::deshabilitar/$1');
    $routes->get('eliminar/(:num)', 'PublicacionController::eliminar/$1');
});

// Usuarios (Requiere autenticación)
$routes->group('usuarios', ['filter' => 'auth'], function($routes) {
    $routes->get('/', 'UsuarioController::index'); // Listar usuarios
    $routes->get('agregar', 'UsuarioController::agregar'); // Mostrar formulario para agregar usuario
    $routes->post('store', 'UsuarioController::store'); // Guardar nuevo usuario
    $routes->get('editar/(:num)', 'UsuarioController::editar/$1'); // Mostrar formulario para editar usuario
    $routes->post('actualizar/(:num)', 'UsuarioController::actualizar/$1'); // Actualizar usuario
    $routes->get('eliminar/(:num)', 'UsuarioController::eliminar/$1'); // Eliminar usuario
});
