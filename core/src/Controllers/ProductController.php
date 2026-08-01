<?php
declare(strict_types=1);

namespace App\Controllers;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Rendering\Renderer;
use App\Repositories\ProductRepository;

final class ProductController
{
    public function __construct(
        private readonly Renderer $renderer,
        private ProductRepository $products,
    ) {}

    public function __invoke(Request $request): Response
    {
        $category = $request->attributes->get('category');

        $product = $this->products->findCategory($category);

        return $this->renderer->render(
            'products/product',
            [
                'product' => $product,
                'title' => $product['title'],
            ]
        );
    }
}


/*
public function __invoke(Request $request): Response
{
    // Имя атрибута должно совпадать с тем, что передает роутер 
    // (например, 'category' или 'slug')
    $slug = $request->attribute('category');

    if (!$slug) {
        return new Response('Product not found', 404);
    }

    // Путь к файлу данных (убедись, что BASE_PATH объявлен в index.php)
    $dataFile = BASE_PATH . "/products/data/{$slug}.php";

    if (!is_file($dataFile)) {
        // Если товара нет, можно отрендерить 404 страницу
        return new Response(
            $this->renderer->render('pages/404'), 
            404
        );
    }

    $product = require $dataFile;

    return Response::html(
        $this->renderer->render(
            'products/product',
            [
                'product' => $product,
                'slug'    => $slug,
            ]
        )
    );
}
*/