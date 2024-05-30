<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Http\Middlewares\ForceJsonResponse;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        api: __DIR__.'/../routes/api.php',
        health: '/up',
        apiPrefix: '/api',
    )
    ->withMiddleware(function (Middleware $middleware) {       
        $middleware->prepend(ForceJsonResponse::class);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
