<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class VerifiedAuth {
  /**
   * Handle an incoming request.
   *
   * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
   */
  public function handle(Request $request, Closure $next): Response {
    if ($request->user()->hasVerifiedEmail()) {
      return $next($request);
    }
    if (!isset($request->user()->email) || !isset($request->user()->username)) {
      return redirect(route('settings', absolute: false))->withFragment('#account');
    }
    return redirect(route('verification.notice', absolute: false));
  }
}
