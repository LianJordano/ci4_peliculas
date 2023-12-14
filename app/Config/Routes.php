<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'dashboard\pelicula::index');


$routes->group("dashboard", function($routes){
    $routes->presenter("pelicula",["controller" => "Dashboard\Pelicula"]);
    $routes->presenter("categoria",["controller" => "Dashboard\Categoria"]);
});
