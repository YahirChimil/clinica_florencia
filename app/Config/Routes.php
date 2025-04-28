<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
//$routes->get('/', 'Home::index');
$routes->get('/', 'Home::informacion');
//$routes->get('citas', 'Citas::index');
$routes->get('citas/new', 'Citas::new');

$routes->resource('citas', [
    'placeholder' => '(:num)',
    'except' => ['show', 'create'], // Excluye el método 'create'
    'filter' => 'session'
]);

// Ruta para el método 'create' sin filtro de sesión
$routes->get('citas/new', 'Citas::new');
$routes->post('citas', 'Citas::create');

$routes->get('citas/horas-disponibles', 'Citas::horasDisponibles');
$routes->get('citas/horas-disponibles', 'Citas::horasDisponibles');
$routes->get('citas/cancelar-cita', 'Citas::formCancelarCita');
$routes->post('citas/cancelar-cita', 'Citas::cancelar');
$routes->post('citas/guardar-dias-no-laborables', 'DiasNoLaborales::guardarDiasNoLaborables');
$routes->get('citas/dias-no-laborables', 'DiasNoLaborales::obtenerJSON');



service('auth')->routes($routes);
