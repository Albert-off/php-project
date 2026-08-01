<?php
declare(strict_types=1);

namespace App\Routing;

final readonly class RouteMatch
{
    public function __construct(
        public Route $route,
        public array $parameters = [],
    ) {}
}
