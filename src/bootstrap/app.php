<?php

use App\Http\Middleware\TrustHeader;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        api: __DIR__ . '/../routes/api.php',
        health: '/up',
    )->withMiddleware(function (Middleware $middleware) {
        $middleware->use([
            TrustHeader::class
        ]);
    })->withExceptions(function (Exceptions $exceptions) {
    })->create();
