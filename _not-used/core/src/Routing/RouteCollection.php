<?php
declare(strict_types=1);

namespace App\Routing;

final class RouteCollection
{
    /**
     * @var list<Route>
     */
    private array $routes = [];

    public function add(Route $route): void
    {
        $this->routes[] = $route;
    }

    /**
     * @return list<Route>
     */
    public function all(): array
    {
        return $this->routes;
    }
}