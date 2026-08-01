<?php
declare(strict_types=1);

namespace App\Rendering;

use RuntimeException;

final class ViewException extends RuntimeException
{
    public static function missing(string $type, string $file): self
    {
        return new self(
            "{$type} [$file] not found."
        );
    }
}
