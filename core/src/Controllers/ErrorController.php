<?php
declare(strict_types=1);

namespace App\Controllers;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Rendering\Renderer;

final class ErrorController
{
    public function __construct(
        private readonly Renderer $renderer
    ) {}

    public function __invoke(Request $request): Response
    {
        return $this->renderer->render(
            'pages/error', 
            [
                'code' => '404',
                'title' => 'Page not found',
                'description' => 'Sorry, the page you’re looking for doesn’t exist or has been moved.',
            ],
            404
        );
    }
}
