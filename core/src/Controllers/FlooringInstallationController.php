<?php
declare(strict_types=1);

namespace App\Controllers;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Rendering\Renderer;

final class FlooringInstallationController
{
    public function __construct(
        private readonly Renderer $renderer
    ) {}

    public function __invoke(Request $request): Response
    {
        return $this->renderer->render('pages/flooring-installation');
    }
}
