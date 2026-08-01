<?php
declare(strict_types=1);

namespace App\Http\Middleware;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

final class HandleCors implements MiddlewareInterface
{
    public function process(Request $request, callable $next): Response
    {
        return $next($request);
    }
}