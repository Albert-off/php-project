<?php
declare(strict_types=1);

namespace App\Http;

final class Request
{
    /**
     * Данные, которые добавляют middleware/router
     */
    private array $attributes = [];

    public function __construct(
        private array $get,
        private array $post,
        private array $server,
        private array $files,
        private array $cookie,
    ) {}

    public static function capture(): self
    {
        return new self(
            $_GET,
            $_POST,
            $_SERVER,
            $_FILES,
            $_COOKIE,
        );
    }

    public function method(): string
    {
        return strtoupper(
            $this->server['REQUEST_METHOD'] ?? 'GET'
        );
    }

    public function uri(): string 
    {
        $path = parse_url(
            $this->server['REQUEST_URI'] ?? '/',
            PHP_URL_PATH
        );

        if (!is_string($path)) {
            return '/';
        }

        $path = '/' . trim($path, '/');

        return $path === '//'
            ? '/'
            : $path;
    }


    /*
    |--------------------------------------------------------------------------
    | Query parameters
    |--------------------------------------------------------------------------
    */
    public function get(string $key, mixed $default = null): mixed
    {
        return $this->get[$key] ?? $default;
    }


    /*
    |--------------------------------------------------------------------------
    | POST parameters
    |--------------------------------------------------------------------------
    */
    public function post(string $key, mixed $default = null): mixed
    {
        return $this->post[$key] ?? $default;
    }

    public function all(): array
    {
        return array_merge($this->get, $this->post);
    }

    public function file(string $key): mixed
    {
        return $this->files[$key] ?? null;
    }

    public function cookie(string $key, mixed $default = null): mixed
    {
        return $this->cookie[$key] ?? $default;
    }


    /*
    |--------------------------------------------------------------------------
    | Request attributes
    |--------------------------------------------------------------------------
    */
    public function setAttribute(string $key, mixed $value): void
    {
        $this->attributes[$key] = $value;
    }

    public function attribute(string $key, mixed $default = null): mixed
    {
        return $this->attributes[$key] ?? $default;
    }

    public function attributes(): array
    {
        return $this->attributes;
    }

    public function withAttributes(array $attributes): self
    {
        $clone = clone $this;

        $clone->attributes = array_merge(
            $clone->attributes,
            $attributes
        );

        return $clone;
    }
}


/*
Метод capture() — это классический статический фабричный метод (Static Factory Method).
Вместо того чтобы разработчик вручную писал:
$request = new Request($_GET, $_POST, $_SERVER, $_FILES, $_COOKIE);
Он просто пишет красивый и чистый код:
$request = Request::capture();
*/