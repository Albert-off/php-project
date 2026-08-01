<?php
declare(strict_types=1);

namespace App\Http;

final readonly class Response
{
    public function __construct(
        private string $body = '',
        private int $status = 200,
        private array $headers = []
    ) {}

    public static function html(
        string $body,
        int $status = 200
    ): self {
        return new self(
            body: $body,
            status: $status,
            headers: [
                'Content-Type' => 'text/html; charset=UTF-8',
            ],
        );
    }

    public static function json(
        array $data,
        int $status = 200
    ): self {
        return new self(
            body: json_encode(
                $data,
                JSON_UNESCAPED_UNICODE
                | JSON_UNESCAPED_SLASHES
                | JSON_THROW_ON_ERROR
            ),
            status: $status,
            headers: [
                'Content-Type' => 'application/json; charset=UTF-8',
            ],
        );
    }

    public static function redirect(
        string $location,
        int $status = 302
    ): self {
        return new self(
            status: $status,
            headers: [
                'Location' => $location,
            ],
        );
    }

    public static function noContent(): self
    {
        return new self(status: 204);
    }

    /* public static function notFound(): self
    {
        return new self(
            body: '',
            status: 404
        );
    } */

    public function send(): void
    {
        http_response_code($this->status);

        foreach ($this->headers as $name => $value) {
            header("$name: $value");
        }

        echo $this->body;
    }
}