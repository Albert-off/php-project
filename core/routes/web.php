<?php
declare(strict_types=1);

use App\Controllers\HomeController;
use App\Controllers\AboutController;
use App\Controllers\ContactController;
use App\Controllers\FlooringInstallationController;
use App\Controllers\PrivacyPolicyController;
use App\Controllers\ProductsController;
use App\Controllers\ProductController;
use App\Controllers\CarpetDetailController;
use FastRoute\RouteCollector;

return static function (RouteCollector $r): void {
    $r->addRoute('GET', '/', HomeController::class);

    $r->addRoute('GET', '/aboutus', AboutController::class);

    $r->addRoute('GET', '/contact', ContactController::class);

    $r->addRoute('GET', '/flooring-installation', FlooringInstallationController::class);

    $r->addRoute('GET', '/privacy-policy', PrivacyPolicyController::class);

    $r->addRoute('GET', '/products', ProductsController::class);

    $r->addRoute('GET', '/products/{category}', ProductController::class);

    $r->addRoute('GET', '/products/{category}/{product}', CarpetDetailController::class);
};


// этот файл описывает маршруты приложения
// Он просто говорит: "Если существует маршрут /, то он связан с этим обработчиком."