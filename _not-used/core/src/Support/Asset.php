<?php
declare(strict_types=1);

final class Asset
{
    public function __construct(
        private string $baseUrl
    ) {}

    public function url(string $path): string
    {
        return rtrim($this->baseUrl, '/') . '/assets/' . ltrim($path, '/');
    }
}




// if (!function_exists('asset')) {

//     function asset(string $path): string
//     {
//         $config = require BASE_PATH . 'config/app.php';

//         return rtrim(
//             $config['base_url'],
//             '/'
//         ) . '/assets/' . ltrim($path, '/');
//     }
// }