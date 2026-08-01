<?php
declare(strict_types=1);

namespace App\Rendering\Extensions;

use League\Plates\Engine;
use League\Plates\Extension\ExtensionInterface;

final class ViewExtension implements ExtensionInterface
{
    public function __construct(
        private readonly array $config
    ) {}

    public function register(Engine $engine): void
    {
        $engine->registerFunction('baseUrl', $this->baseUrl(...));
        $engine->registerFunction('siteUrl', $this->siteUrl(...));
        $engine->registerFunction('url', $this->url(...));
        $engine->registerFunction('asset', $this->asset(...));
    }

    public function baseUrl(): string
    {
        $baseUrl = rtrim($this->config['base_url'], '/');
        return $baseUrl === '' ? '/' : $baseUrl;
    }

    public function siteUrl(string $path = ''): string
    {
        $siteUrl = rtrim($this->config['site_url'], '/');
        return $siteUrl . '/' . ltrim($path, '/');
    }

    public function url(string $path = ''): string
    {
        $baseUrl = $this->baseUrl();
        $basePath = $baseUrl === '/' ? '' : $baseUrl;
        return $basePath . '/' . ltrim($path, '/');
    }

    public function asset(string $path): string
    {
        $baseUrl = $this->baseUrl();
        $basePath = $baseUrl === '/' ? '' : $baseUrl;
        return $basePath . '/assets/' . ltrim($path, '/');
    }
}