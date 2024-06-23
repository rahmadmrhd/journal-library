<?php

use App\Http\Middleware\SubGateMiddleware;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;

return Application::configure(basePath: dirname(__DIR__))
  ->withRouting(
    web: __DIR__ . '/../routes/web.php',
    commands: __DIR__ . '/../routes/console.php',
    health: '/up',
  )
  ->withMiddleware(function (Middleware $middleware) {
    $middleware->alias([
      'verified' => App\Http\Middleware\VerifiedAuth::class,
      'role' => App\Http\Middleware\RoleAuth::class,
      'remove_params' => App\Http\Middleware\RemoveParams::class,
      'sub_gate' => SubGateMiddleware::class
    ]);
    // $middleware->web(append: [SubGateMiddleware::class]);
    $middleware->redirectUsersTo(fn (Request $request) => route('dashboard', $request->route()->parameter('subGate')));
    $middleware->redirectGuestsTo(fn (Request $request) => route('login', $request->route()->parameter('subGate')));
  })
  ->withExceptions(function (Exceptions $exceptions) {
    //
  })->create();
