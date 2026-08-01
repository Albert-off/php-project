<?php
// Включаем строгую типизацию PHP 8.2
declare(strict_types=1);

// Начинаем сессию (нужно для авторизации и админки)
session_start();


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
// require BASE_PATH . 'src/config.php';


$container = require BASE_PATH . 'config/container.php';


// Router
$router = $container->get(App\Routing\Router::class);

// Register routes
(require BASE_PATH . 'routes/web.php')($router);

// Request
$request = App\Http\Request::capture();

// Dispatch
$response = $router->dispatch($request);


$response->send();





/*

// Получаем запрашиваемый URL (если пусто, значит это главная страница)
// $url = isset($_GET['url']) ? rtrim($_GET['url'], '/') : 'home';

$url = trim(
    parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH),
    '/'
);


// --- ПРОСТЕЙШИЙ РОУТЕР ---

// Подключаем шапку сайта
// require_once BASE_PATH . 'includes/header.php';


// var_dump($_SERVER['REQUEST_URI']);
// var_dump($url);
// exit;


// Выбираем контент в зависимости от URL
$routes = [
    ''                        => 'pages/home',
    'aboutus'                 => 'pages/aboutus',
    'contact'                 => 'pages/contact',
    'flooring-installation'   => 'pages/flooring-installation',
    'privacy-policy'          => 'pages/privacy-policy',

    'products'                => 'products/index',

    'logout'                  => 'actions/logout',

    'admin/posts'             => 'admin/posts/index',
    // ...
];

// ---------- Dynamic routes ----------
if (str_starts_with($url, 'products/')) {
    // $slug = substr($url, strlen('products/'));
    // require BASE_PATH . 'products/product.php';
    // exit;

    $parts = explode('/', $url);

    // Сценарий А: URL вида /products/carpet (Категория)
    if (count($parts) === 2) {
        $slug = $parts[1]; // 'carpet'

        // Передаем управление в общую карточку категории/продукта
        require BASE_PATH . 'products/product.php';
        exit;
    }

    // Сценарий Б: URL вида /products/carpet/smarthcushion (Конкретный бренд/продукт)
    if (count($parts) === 3) {
        $category = $parts[1]; // 'carpet'
        $slug = $parts[2];     // 'smarthcushion'

        require BASE_PATH . 'products/carpet-detail.php';
        exit;
    }
}

// ---------- Static routes ----------
$route = $routes[$url] ?? null;

if ($route === null) {
    // Если страница не найдена - отдаем правильный SEO код 404
    http_response_code(404);
    require BASE_PATH . 'pages/404.php';
    exit;
}

require BASE_PATH . $route . '.php';


// Подключаем подвал сайта
// require_once BASE_PATH . 'includes/footer.php';

*/
