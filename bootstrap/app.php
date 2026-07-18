<?php

use App\Http\Middleware\SetTeamUrlDefaults;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;


return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->web(append: [
            SetTeamUrlDefaults::class,
        ]);
        // $middleware->statefulApi() // HABIULITAR LA AUHT en Cookies;
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        
        $exceptions->render(function (NotFoundHttpException $e, $request) {
            if($request->expectsJson()) { 
                return response()->json('Not found', 404);
            }
        });

        // $exceptiones->render(function (NotFoundHttpException $e, $request) {
        //     if($request->expectsJson()) { // or $request->wantsJson()
        //         return response()->json('Not found', 404);
        //     }
        // });

    })->create();
