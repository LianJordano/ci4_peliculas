<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'dashboard\pelicula::index');


$routes->group('api', function ($routes) {
    $routes->resource('pelicula', ['controller' => 'Api\Pelicula']);
    $routes->resource('categoria', ['controller' => 'Api\Categoria']);
});

$routes->group("dashboard", function($routes){
    $routes->presenter("pelicula",["controller" => "Dashboard\Pelicula"]);
    $routes->presenter("categoria",["controller" => "Dashboard\Categoria"]);
});

$routes->get("traficar", "web\usuario::traficarUsuario");
$routes->get('login', 'web\usuario::login');
$routes->post('login_post', 'web\usuario::login_post');
$routes->get('register', 'web\usuario::register');
$routes->post('register_post', 'web\usuario::register_post');
$routes->get('logout', 'web\usuario::logout');

