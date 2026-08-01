<?php
declare(strict_types=1);

namespace App\Routing;

use App\Http\Request;

final class RouteMatcher
{
    /**
     * @param list<Route> $routes
     */
    public function match(Request $request, array $routes): RouteMatch 
    {
        foreach ($routes as $route) {
            if (!$route->matchesMethod($request->method())) {
                continue;
            }

            $parameters = $this->matchPath(
                $route,
                $request->uri()
            );

            if ($parameters === null) {
                continue;
            }

            return new RouteMatch($route, $parameters);
        }

        throw new RouteNotFoundException(
            $request->method(), 
            $request->uri()
        );
    }

    private function matchPath(Route $route, string $uri): ?array 
    {
        $routeSegments = $route->segments();

        $uriSegments = $uri === '/'
            ? []
            : explode('/', trim($uri, '/'));

        if (count($routeSegments) !== count($uriSegments)) {
            return null;
        }

        $parameters = [];

        foreach ($routeSegments as $index => $segment) {
            
            $value = $uriSegments[$index];

            /*
             * Dynamic parameter
             *
             * {category}
             */
            if (
                str_starts_with($segment, '{') 
                && str_ends_with($segment, '}')
            ) {
                $name = trim($segment, '{}');
                $parameters[$name] = $value;
                continue;
            }

            /*
             * Static segment
             */
            if ($segment !== $value) {
                return null;
            }
        }

        return $parameters;
    }
}