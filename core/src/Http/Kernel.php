<?php
declare(strict_types=1);

namespace App\Http;

use App\Routing\FastRouteRouter;
use App\Routing\ControllerDispatcher;
use App\Exceptions\ExceptionHandler;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Middleware\HandleCors;
use App\Http\Middleware\LogRequests;
use App\Http\Middleware\StartSession;
use App\Http\Middleware\VerifyCsrfToken;
use App\Http\Middleware\Authenticate;
use Throwable;

final class Kernel
{
    public function __construct(
        private readonly FastRouteRouter $router,
        private readonly ControllerDispatcher $controllerDispatcher,
        private readonly Pipeline $pipeline,
        private readonly ExceptionHandler $exceptions,
    ) {}

    public function handle(Request $request): Response
    {
        try {
            return $this->pipeline
                ->send($request)
                ->through([
                    HandleCors::class,
                    LogRequests::class,
                    StartSession::class,
                    VerifyCsrfToken::class,
                    Authenticate::class,
                ])
                ->then(
                    function(Request $request): Response {
                        $route = $this->router->match(
                            $request->getMethod(),
                            $request->getPathInfo()
                        );

                        return $this->controllerDispatcher->dispatch(
                            $route,
                            $request
                        );
                    }
                );
            
        } catch (Throwable $exception) {
            return $this->exceptions->handle($exception);
        }
    }
}