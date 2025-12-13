<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        
        // 💡 ADD THIS SECTION TO REGISTER YOUR CUSTOM MIDDLEWARE ALIASES
        $middleware->alias([
            'auth' => \App\Http\Middleware\Authenticate::class,
            // Add other default aliases if they were here, e.g., 'guest'
            
            // This is the CRUCIAL line that maps 'role' to your class:
            'role' => \App\Http\Middleware\RoleMiddleware::class,
        ]);
        
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();