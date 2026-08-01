<?php
declare(strict_types=1);

namespace App\Exceptions;

use App\Rendering\Renderer;
use Psr\Log\LoggerInterface;
use Throwable;
use Symfony\Component\HttpFoundation\Response;
use App\Routing\RouteNotFoundException;
use App\Repositories\ProductNotFoundException;
use App\Routing\MethodNotAllowedException;
use App\Rendering\ViewException;
use App\Rendering\View;

final class ExceptionHandler
{
    public function __construct(
        private readonly Renderer $renderer,
        private readonly LoggerInterface $logger,
    ) {}

    public function handle(Throwable $exception): Response 
    {
        if ($this->shouldLog($exception)) {
            $this->logger->error(
                $exception->getMessage(),
                [
                    'exception' => $exception,
                ]
            );
        }

        return match (true) {
            $exception instanceof RouteNotFoundException
            || $exception instanceof ProductNotFoundException
                => $this->error(
                    404,
                    'Page not found',
                    'Sorry, the page you’re looking for doesn’t exist or has been moved.'
                ),

            $exception instanceof MethodNotAllowedException
                => $this->error(
                    405,
                    'Method Not Allowed',
                    'The requested HTTP method is not allowed for this resource.'
                ),
            
            // $exception instanceof ViewException 
            //     => $this->error500($exception),

            default 
                => $this->error(
                    500,
                    'Internal Server Error',
                    'Oops! Something went wrong on our side. We are already fixing it.'
                ),
        };
    }

    private function error(int $status, string $title, string $description): Response
    {
        // return $this->renderer->html(
        //     View::make('pages/error', [
        //         'code'        => (string) $status,
        //         'title'       => $title,
        //         'description' => $description
        //     ]),
        //     $status
        // );

        return $this->renderer->render(
            'pages/error', 
            [
                'code'        => (string) $status,
                'title'       => $title,
                'description' => $description
            ],
            $status
        );
    }

    private function shouldLog(Throwable $exception): bool
    {
        return !$exception instanceof RouteNotFoundException
            && !$exception instanceof MethodNotAllowedException
            && !$exception instanceof ProductNotFoundException;
    }
}
