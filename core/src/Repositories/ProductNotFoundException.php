<?php
declare(strict_types=1);

namespace App\Repositories;

use RuntimeException;


final class ProductNotFoundException extends RuntimeException
{
    // Вместо метода и пути передаем slug или ID товара, который не нашли
    public function __construct(string $slug)
    {
        parent::__construct(
            sprintf('Product resource [%s] not found.', $slug)  
        );
    }
}