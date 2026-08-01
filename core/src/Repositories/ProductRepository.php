<?php
declare(strict_types=1);

namespace App\Repositories;


final class ProductRepository
{
    public function findCategory(string $slug): array
    {
        return $this->load(
            BASE_PATH . "views/products/data/{$slug}.php",
            $slug
        );
    }

    public function findProductDetail(string $category, string $product): array
    {
        return $this->load(
            BASE_PATH . "views/products/data/{$category}/{$product}.php",
            "{$category}/{$product}"
        );
    } 

    private function load(string $file, string $slug): array
    {
        if (!is_file($file)) { 
            throw new ProductNotFoundException($slug);
        }

        return require $file;
    }
}