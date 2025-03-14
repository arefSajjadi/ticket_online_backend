<?php

use App\Http\Middleware\TrustHeader;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        api: __DIR__ . '/../routes/api.php',
        health: '/up',
    )->withMiddleware(function (Middleware $middleware) {
        $middleware->use([
            TrustHeader::class
        ]);
    })->withExceptions(function (Exceptions $exceptions) {
        $exceptions->respond(function (Response $response, Throwable $throwable) {
            $data = 'application_error';

            $ApplicationException = [
                Exception::class,
                ValidationException::class,
            ];

            if (app()->hasDebugModeEnabled() or in_array(get_class($throwable), $ApplicationException)) {
                $data = json_decode($response->getContent(), true);
            }

            return responseShape(
                error: true,
                code: $response->getStatusCode(),
                data: $data,
                httpStatus: $response->getStatusCode()
            );
        });
    })->create();
