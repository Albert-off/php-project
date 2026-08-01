<?php
declare(strict_types=1);

namespace App\Controllers;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Rendering\Renderer;

final class HomeController
{
    public function __construct(
        private readonly Renderer $renderer
    ) {}

    public function __invoke(Request $request): Response
    {
        /*
        // пока просто подключаем существующую страницу
        require BASE_PATH . 'pages/home.php';

        return Response::ok();
        */

        return $this->renderer->render(
            'pages/home',
            [
                'title' => 'Ring Road Flooring'
            ]
        );
    }
}




// Раньше было так:
// return $this->renderer->html(
//     View::make(
//         'pages/home',
//         [
//             'title' => 'Ring Road Flooring'
//         ]
//     )
// );