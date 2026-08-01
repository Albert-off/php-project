<?php
declare(strict_types=1);

namespace App\Routing;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FastRoute\Dispatcher;
use Psr\Container\ContainerInterface;
use LogicException;

final readonly class ControllerDispatcher
{
    public function __construct(
        private ContainerInterface $container,
    ) {}

    /**
     * @param array<int, mixed> $routeInfo
     */
    public function dispatch(array $routeInfo, Request $request): Response 
    {
        $status = $routeInfo[0];

        switch ($status) {
            case Dispatcher::FOUND:
                [, $handler, $parameters] = $routeInfo;
                break;

            case Dispatcher::NOT_FOUND:
                throw new RouteNotFoundException($request->getMethod(), $request->getPathInfo());

            case Dispatcher::METHOD_NOT_ALLOWED:
                [, $allowedMethods] = $routeInfo;
                throw new MethodNotAllowedException($request->getMethod(), $allowedMethods);
            
            default:
                throw new LogicException('Unexpected routing result.');
        }

        foreach ($parameters as $key => $value) {
            $request->attributes->set($key, $value);
        }

        $controller = $this->container->get($handler);
        
        return $controller($request);
    }
}