<?php
declare(strict_types=1);

namespace App\Rendering;

final readonly class ViewEnvironment
{
    public function __construct(
        private array $config,
    ) {}


    /*
    |--------------------------------------------------------------------------
    | URLs
    |--------------------------------------------------------------------------
    */

    public function baseUrl(): string
    {
        $baseUrl = rtrim($this->config['base_url'], '/');

        // Если base_url изначально был '/' или пустой строкой, 
        // возвращаем '/', чтобы корень сайта не превращался в пустоту.
        return $baseUrl === '' ? '/' : $baseUrl;
    }

    public function siteUrl(string $path = ''): string
    {
        $site = rtrim($this->config['site_url'], '/');
        
        return $site . '/' . ltrim($path, '/');
    }

    // Относительный URL от корня приложения (например: "/path" или "/subfolder/path")
    public function url(string $path = ''): string
    {
        return $this->basePath() . '/' . ltrim($path, '/');
    }

    public function asset(string $path): string
    {
        return $this->url('assets/' . ltrim($path, '/'));
    }

    private function basePath(): string
    {
        $baseUrl = $this->baseUrl();

        return $baseUrl === '/' ? '' : $baseUrl;
    }


    /*
    |--------------------------------------------------------------------------
    | Views
    |--------------------------------------------------------------------------
    */

    public function view(string $view): string
    {
        return $this->path('views') . '/' . trim($view, '/') . '.php';
    }

    public function layout(string $layout): string
    {
        return $this->path('layouts') . '/' . trim($layout, '/') . '.php';
    }

    public function component(string $component): string
    {
        return $this->path('components') . '/' . trim($component, '/') . '.php';
    }


    /*
    |--------------------------------------------------------------------------
    | Paths
    |--------------------------------------------------------------------------
    */

    private function path(string $key): string
    {
        return rtrim(
            $this->config['paths'][$key],
            '/'
        );
    }
}