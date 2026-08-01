<?php
declare(strict_types=1);

namespace App\Rendering;

final readonly class View
{
    public function __construct(
        public string $template,
        public array $data = [],
        public string $layout = 'app',
    ) {}

    public static function make(
        string $template, 
        array $data = [], 
        string $layout = 'app'
    ): self {
        return new self(
            $template, 
            $data, 
            $layout
        );
    }
}