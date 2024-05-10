<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RemoveParams {

  /**
   * Handle an incoming request.
   *
   * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
   */
  public function handle(Request $request, Closure $next, ...$params): Response {
    if ($request->query->count() == 0) {
      return $next($request);
    }

    $query = collect($request->query->keys());
    $params = collect($params);
    if ($params->isEmpty()) {
      $params = $query;
    } else {
      $condition = $params->contains(function ($param) use ($query) {
        return $query->contains($param);
      });
      if (!$condition) {
        return $next($request);
      }
    }
    foreach ($params as $param) {
      $request->query->remove($param);
    }

    return redirect()->to($request->fullUrlWithoutQuery(''));
  }
}
