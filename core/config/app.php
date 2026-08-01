<?php
declare(strict_types=1);

return [
    'base_url' => $_ENV['APP_BASE_URL'],
    'site_url' => $_ENV['APP_URL'],
    'paths' => [
        'views' => BASE_PATH . 'views',
        'layouts' => BASE_PATH . 'views/layouts',
        'components' => BASE_PATH . 'views/components',
        // 'product_data' => BASE_PATH.'views/products/data',
    ],
];



// Used to create absolute URLs for resources on a site.
// 'site_url' => 'https://ringroadflooring.local'