<?php
declare(strict_types=1);

namespace App\Routing;

use RuntimeException;


final class MethodNotAllowedException extends RuntimeException
{
    /**
     * @param list<string> $allowedMethods
     */
    public function __construct(string $method, array $allowedMethods)
    {
        parent::__construct(
            sprintf(
                'Method [%s] not allowed. Allowed methods: %s.', 
                $method, 
                implode(', ', $allowedMethods)
            )
        );
    }
}