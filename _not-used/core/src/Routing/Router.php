<?php
declare(strict_types=1);

namespace App\Routing;

use App\Http\Request;
use App\Http\Response;

final class Router
{
    public function __construct(
        private RouteCollection $routes,
        private RouteMatcher $matcher,
        private ControllerDispatcher $dispatcher
    ) {}


    // Методы возвращает текущий объект Router чтобы можно было писать цепочки, например $router ->get(...) ->get(...) ->post(...) 

    public function get(string $path, string $handler): self
    {
        $this->add('GET', $path, $handler);
        return $this;
    }

    public function post(string $path, string $handler): self
    {
        $this->add('POST', $path, $handler);
        return $this;
    }

    private function add(string $method, string $path, string $handler): void
    {
        $this->routes->add(
            new Route(
                $method,
                $this->normalize($path), // $path,
                $handler
            )
        );
    }

    public function dispatch(Request $request): Response 
    {
        $match = $this->matcher->match(
            $request,
            $this->routes->all()
        );

        return $this->dispatcher->dispatch($match, $request);
    }

    private function normalize(string $path): string
    {
        $path = '/' . trim($path, '/');

        return $path === '//' ? '/' : $path;
    }
}