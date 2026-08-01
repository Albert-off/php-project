<?php
declare(strict_types=1);

namespace App\Http;

use DI\Container;
use RuntimeException;
use App\Http\Middleware\MiddlewareInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

final class Pipeline
{
    private Request $request;
    private array $middlewares = [];

    public function __construct(
        private readonly Container $container,
    ) {}

    public function send(Request $request): self
    {
        $this->request = $request;
        return $this;
    }

    /**
     * @param list<class-string<MiddlewareInterface>> $middlewares
     */
    public function through(array $middlewares): self
    {
        $this->middlewares = $middlewares;
        return $this;
    }

    public function then(callable $destination): Response
    {
        $pipeline = array_reduce(
            array_reverse($this->middlewares),
            
            function(callable $next, string $middleware): callable {

                return function (Request $request) use ($middleware, $next): Response {

                    $instance = $this->container->get($middleware);

                    if (!$instance instanceof MiddlewareInterface) {
                        throw new RuntimeException(
                            sprintf('%s must implement MiddlewareInterface.', $middleware)
                        );
                    }

                    return $instance->process($request, $next);
                };

            },

            $destination
        );
        
        return $pipeline($this->request);
    }
}
