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
    
    $routes->get('pelicula/etiquetas/(:num)', 'Dashboard\pelicula::etiquetas/$1');
    $routes->post('pelicula/etiquetas_post/(:num)', 'Dashboard\pelicula::etiquetas_post/$1');
    $routes->post('pelicula/(:num)/etiqueta/(:num)/delete', 'Dashboard\pelicula::etiqueta_delete/$1/$2');
    $routes->post('pelicula/imagen_delete/(:num)', 'Dashboard\pelicula::borrarImagen/$1');
    $routes->post('pelicula/imagen_descargar/(:num)', 'Dashboard\pelicula::descargarImagen/$1');
    //$routes->post('pelicula/(:num)/etiqueta/(:num)/delete', 'Dashboard\Pelicula\etiqueta_delete/$1/$2', ["as" => "pelicula.etiqueta_delete"]);
    
    $routes->presenter("pelicula",["controller" => "Dashboard\Pelicula"]);
    $routes->presenter("categoria",["controller" => "Dashboard\Categoria"]);
    $routes->presenter("etiqueta",["controller" => "Dashboard\Etiqueta"]);


});

$routes->get("traficar", "web\usuario::traficarUsuario");
$routes->get('login', 'web\usuario::login');
$routes->post('login_post', 'web\usuario::login_post');
$routes->get('register', 'web\usuario::register');
$routes->post('register_post', 'web\usuario::register_post');
$routes->get('logout', 'web\usuario::logout');

