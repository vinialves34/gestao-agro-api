<?php

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        //
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        $exceptions->renderable(function (Throwable $e, $request) {
            if (str_starts_with($request->path(), 'api/')) {
                if ($e instanceof ModelNotFoundException ||
                    $e instanceof NotFoundHttpException) {

                    return response()->json([
                        'success' => false,
                        'message' => 'Resource not found',
                        'status_code' => 404,
                        'error' => $e->getMessage()
                    ], 404);
                }

                if ($e instanceof ValidationException) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Validation error',
                        'status_code' => 422,
                        'errors' => $e->errors()
                    ], 422);
                }

                return response()->json([
                    'success' => false,
                    'message' => 'Internal server error',
                    'status_code' => 500,
                    'error' => $e->getMessage()
                ], 500);
            }
        });
    })->create();
