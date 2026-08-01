<?php
declare(strict_types=1);

namespace App\Controllers;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Rendering\Renderer;
use App\Repositories\ProductRepository;

final class CarpetDetailController
{
    public function __construct(
        private readonly Renderer $renderer,
        private readonly ProductRepository $repository
    ) {}

    public function __invoke(Request $request): Response
    {
        // Динамические параметры из роутера попадают в атрибуты Request
        $category = $request->attributes->get('category');
        $product = $request->attributes->get('product');

        // Ищем товар через репозиторий
        $product = $this->repository->findProductDetail($category, $product);

        // Если товар не найден — код здесь останавливается, 
        // выбрасываем исключение который в итоге цепочки событий отдает системный 404 

        // Рендерим шаблон, передавая туда переменные $product и $title
        return $this->renderer->render(
            'products/carpet-detail',
            [
                'product' => $product,
                'title' => $product['title'] ?? 'Product Details',
            ]
        );
    }
}
