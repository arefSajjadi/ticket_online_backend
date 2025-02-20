<?php

use App\Http\Middleware\TrustHeader;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;
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
        $exceptions->render(function (Exception $exception, Request $request) {
            if ($exception instanceof QueryException and !app()->hasDebugModeEnabled()) {
                $message = 'server error';
            }

            if (is_numeric($exception->getCode()) and $exception->getCode() != 0) {
                $code = $exception->getCode();
            } elseif ($exception instanceof ValidationException) {
                $code = 422;
            }

            return response([
                'message' => $message ?? $exception->getMessage(),
            ], $code ?? Response::HTTP_INTERNAL_SERVER_ERROR);
        });
    })->create();
