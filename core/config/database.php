<?php
declare(strict_types=1);

return [
    'host'     => $_ENV['DB_HOST'],
    'port'     => (int) $_ENV['DB_PORT'],
    'name'     => $_ENV['DB_DATABASE'],
    'username' => $_ENV['DB_USERNAME'],
    'password' => $_ENV['DB_PASSWORD'],
];