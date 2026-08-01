<?php
declare(strict_types=1);

namespace App\Routing;

final readonly class Route
{
    public function __construct(
        public string $method,
        public string $path,
        public string $handler,
        public ?string $name = null,
    ) {}

    public function matchesMethod(string $method): bool
    {
        return $this->method === strtoupper($method);
    }

    public function segments(): array
    {
        if ($this->path === '/') {
            return [];
        }

        return explode(
            '/',
            trim($this->path, '/')
        );
    }
}

/*
Он просто хранит данные.
Например:

GET
/products
ProductController

Это одна запись.
Именно она и называется Route.
*/
