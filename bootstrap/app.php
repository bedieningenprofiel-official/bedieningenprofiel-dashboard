<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->group('web', [
            'Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse',
            'Illuminate\Session\Middleware\StartSession',
            'Illuminate\View\Middleware\ShareErrorsFromSession',
            'Illuminate\Routing\Middleware\SubstituteBindings',
            'App\Http\Middleware\SetLocale',
        ]);
        $middleware->group('auth', [
            'Illuminate\Auth\Middleware\Authenticate',
            'App\Http\Middleware\PlanMiddleware',
        ]);
        $middleware->group('teams', [
            'App\Http\Middleware\CanCreateTeamsMiddleware',
            'App\Http\Middleware\TeamUserLimit',
        ]);
        $middleware->group('church', [
            'App\Http\Middleware\CanCreateChurchMiddleware',
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
