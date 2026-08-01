<?php
declare(strict_types=1); // Включаем строгую типизацию PHP 8.2

use Dotenv\Dotenv;
use Symfony\Component\HttpFoundation\Request;

session_start(); // Начинаем сессию (нужно для авторизации и админки)


// If I want to make my own redirect with correct URL
/*
$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

if ($path !== '/' && preg_match('#/+$#', $path)) {

    $cleanPath = rtrim($path, '/');

    $query = $_SERVER['QUERY_STRING'];

    if ($query !== '') {
        $cleanPath .= '?' . $query;
    }

    header("Location: $cleanPath", true, 301);
    exit;
}
*/


// Определяем базовые пути для удобства (указываем на защищенную папку core)
define('BASE_PATH', dirname(__DIR__) . '/core/');
// __DIR__ = /home/user/ringroadflooring.ca/public_html
// dirname = /home/user/ringroadflooring.ca
// + '/core/' = /home/user/ringroadflooring.ca/core/

// Подключаем конфиг и Composer
require BASE_PATH . 'vendor/autoload.php';

// Загружаем vlucas/phpdotenv
Dotenv::createImmutable(BASE_PATH)->load();

$container = require BASE_PATH . 'config/container.php';


// Это больше не нужно. FastRouteRouter сам загрузит routes/web.php

// // Router
// $router = $container->get(FastRouteRouter::class);

// // Register routes
// (require BASE_PATH . 'routes/web.php')($router);


// Request
// $request = App\Http\Request::capture();

// Захватываем стандартный Request от Symfony
$request = Request::createFromGlobals();

// Dispatch
$kernel = $container->get(App\Http\Kernel::class);

$kernel->handle($request)->send();

// $response = $router->dispatch($request);
// $response->send();


/*
Тогда index.php станет действительно фронт-контроллером, который только:

1. загружает автозагрузчик;
2. собирает контейнер;
3. создает Request;
4. передает его в Kernel;
5. отправляет Response.


Он вообще ничего не знает
о Router
о RouteCollection
о web.php
о Controller
*/