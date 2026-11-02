<?php

use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

// Determina si la aplicacion esta manteniendo o no el sitio.
if (file_exists($maintenance = __DIR__.'/../storage/framework/maintenance.php')) {
    require $maintenance;
}

// Registra el auto-loader de composer.
require __DIR__.'/../vendor/autoload.php';

// Bootstrap Laravel y maneja de la solicitud entrante.
/** @var Application $app */
$app = require_once __DIR__.'/../bootstrap/app.php';

$app->handleRequest(Request::capture());   
