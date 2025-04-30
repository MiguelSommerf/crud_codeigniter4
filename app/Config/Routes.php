<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->post('Controllers/Login', 'Login::validarLogin', ['as' => 'validarLogin']);
