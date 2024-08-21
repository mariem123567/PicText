<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Http\Middleware\AuthAdmin;
use App\Http\Middleware\AuthUser;
use App\Http\Middleware\GuestGeneral;
use App\Http\Middleware\AuthGeneral;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([

           
                'auth.user' =>  AuthUser::class,
                'auth.admin' => AuthAdmin::class,
                'guest.general' => GuestGeneral::class,
                'auth.general' => AuthGeneral::class,
            
            

        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
