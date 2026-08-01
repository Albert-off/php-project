<?php
declare(strict_types=1);

use DI\ContainerBuilder;

use League\Plates\Engine;
use App\Rendering\Extensions\ViewExtension;

use Monolog\Logger;
use Monolog\Level;
use Monolog\Handler\StreamHandler;

use Psr\Log\LoggerInterface;

use function DI\factory;

use Symfony\Component\Validator\Validation;
use Symfony\Component\Validator\Validator\ValidatorInterface;


$app = require BASE_PATH . 'config/app.php';

$builder = new ContainerBuilder();
$builder->useAttributes(false);

$builder->addDefinitions([

    // Регистрируем Plates Engine в контейнере
    Engine::class => factory(
        static function () use ($app): Engine {
            // Передаем путь к папке с вашими представлениями (views)
            $engine = new Engine($app['paths']['views']);

            // Здесь в будущем мы сможем зарегистрировать глобальные функции (asset, url и т.д.)
            // Подключаем наше расширение через стандартный метод Plates
            $engine->loadExtension(new ViewExtension($app));
            
            return $engine;
        }
    ),

    LoggerInterface::class => factory(
        static function (): Logger {
            $logger = new Logger('app');

            $logger->pushHandler(
                new StreamHandler(
                    BASE_PATH . 'storage/logs/app.log',
                    Level::Debug
                )
            );

            return $logger;
        }
    ),

    ValidatorInterface::class => factory(
        static fn (): ValidatorInterface =>
            Validation::createValidatorBuilder()
                ->enableAttributeMapping() // Включаем поддержку PHP-атрибутов (#[Assert\...])
                ->getValidator()
    ),
]);

return $builder->build();




/*
Вот здесь я бы немного изменил подход.

Ты предлагаешь

Router::class => autowire(),
RouteCollection::class => autowire(),
RouteMatcher::class => autowire(),
ControllerDispatcher::class => autowire(),

Это работать будет.

Но...

Я бы сейчас сделал так
$builder = new ContainerBuilder();

$builder->useAttributes(false);

$builder->addDefinitions([
]);

return $builder->build();

Почему?

Потому что PHP-DI умеет автоматически создавать

Router
↓
RouteMatcher
↓
ControllerDispatcher
↓
Renderer

без единой строки.

То есть
$container->get(Router::class);
уже работает.


Когда писать определения?

Когда появятся вещи вроде
PDO
SwiftMailer
Twig
Monolog
Redis
SMTP
Filesystem

Вот тогда definitions становятся очень полезными.
А пока autowire() просто дублирует поведение контейнера.

То есть
Router::class => autowire()

не делает ничего нового.

Поэтому я бы пока definitions вообще оставил пустыми.
*/
