<?php
declare(strict_types=1);

namespace App\Controllers;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

final class SubscriptionController
{
    public function __invoke(Request $request): Response
    {
        throw new \Exception('Not implemented');
    }
}
