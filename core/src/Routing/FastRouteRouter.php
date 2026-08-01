<?php
declare(strict_types=1);

namespace App\Routing;

use FastRoute\Dispatcher;

use function FastRoute\simpleDispatcher;

final readonly class FastRouteRouter
{
    private Dispatcher $dispatcher;

    public function __construct()
    {
        $this->dispatcher = simpleDispatcher(
            require BASE_PATH . 'routes/web.php'
        );
    }

    // Match current request against registered routes.
    public function match(string $method, string $uri): array
    {
        return $this->dispatcher->dispatch($method, $uri);
    }
}