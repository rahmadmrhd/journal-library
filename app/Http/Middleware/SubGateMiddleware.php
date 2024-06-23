<?php

namespace App\Http\Middleware;

use App\Models\SubGate;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpFoundation\Response;

class SubGateMiddleware {
  /**
   * Handle an incoming request.\
   *
   * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
   */
  public function handle(Request $request, Closure $next): Response {
    $subGate = $request->route()->parameter('subGate');

    if ($subGate->slug == 'superadmin') {
      return $next($request);
    }

    if (!$subGate) {
      abort(404);
    }

    if (Auth::check()) {
      if ($request->user()->roles()->wherePivot('sub_gate_id', $subGate->id)->count() <= 0) {
        $request->user()->roles()->attach([
          1 => ['sub_gate_id' => $subGate->id],
          2 => ['sub_gate_id' => $subGate->id]
        ]);
      }
    }

    return $next($request);
  }
}
