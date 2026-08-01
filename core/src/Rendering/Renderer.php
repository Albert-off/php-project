<?php
declare(strict_types=1);

namespace App\Rendering;

use League\Plates\Engine;
use Symfony\Component\HttpFoundation\Response;


final readonly class Renderer
{
    public function __construct(
        private Engine $engine
    ) {}

    public function render(
        string $template, 
        array $data = [], 
        int $status = Response::HTTP_OK
    ): Response {
        return new Response(
            $this->engine->render($template, $data),
            $status,
            // ['Content-Type' => 'text/html; charset=UTF-8',]
        );
    }
}