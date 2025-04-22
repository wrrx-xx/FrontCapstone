<?php

use App\Http\Controllers\Owner;
use App\Http\Middleware\Admin;
use App\Http\Middleware\Guest;
use App\Http\Middleware\Staff;
use App\Http\Middleware\Tenant;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'admin' => Admin::class,
            'owner'=> Owner::class,
            'staff'=> Staff::class,
            'tenant'=> Tenant::class,
            'guest'=> Guest::class
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
