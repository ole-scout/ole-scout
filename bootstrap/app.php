<?php

use App\Http\Middleware\ConsensualCookies;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        ConsensualCookies::except('/consent');
        VerifyCsrfToken::except('/consent');
        $middleware->prependToGroup("web", ConsensualCookies::class);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();