<?php
declare(strict_types=1);

namespace App\Routing;

use RuntimeException;


final class RouteNotFoundException extends RuntimeException
{
    public function __construct(string $method, string $path)
    {
        parent::__construct(
            sprintf('Route [%s %s] not found.', $method, $path)
        );
    }
}