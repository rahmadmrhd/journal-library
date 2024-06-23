<?php

namespace App\Http\Middleware;

use App\Models\Role;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;
use Symfony\Component\HttpFoundation\Response;

class RoleAuth {
  /**
   * Handle an incoming request.
   *
   * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
   */
  public function handle(Request $request, Closure $next, ...$role_name): Response {
    $role_name = collect($role_name)->map(fn ($role) => str_replace(' ', '', $role))->toArray();

    $subGate = $request->route()->parameter('subGate');
    $user = $request->user();
    $rulesUser = $user->roles()
      ->wherePivot('sub_gate_id', $subGate->id)->get();

    //lakukan pengecekan apakah daftar roles yang diizinkan ditemukan pada daftar roles user
    if (count(array_intersect($rulesUser->pluck('slug')->toArray(), $role_name)) > 0) {
      $currentRole = $rulesUser->where('slug', $user->currentRole->slug)->first();
      //TODO
      /**
       * @disregard 
       */
      if (!in_array($currentRole->slug ?? '', $role_name)) {
        if (!$currentRole) {
          $request->request->add([
            'role_error' => [
              'message' => 'Your role cannot be found',
              'url_back' => URL::previous(),
              'role_recomended' => $rulesUser->whereIn('slug', $role_name),
            ],
          ]);
        } else {
          $request->request->add([
            'role_error' => [
              'message' => 'The "' . $currentRole->name . '" role is not authorized to access this page.',
              'url_back' => URL::previous(),
              'role_recomended' => $rulesUser->whereIn('slug', $role_name),
            ],
          ]);
        }
        if ($request->method() != 'GET') {
          return abort(403);
        }
      }
      return $next($request);
    }
    return abort(404);
  }
}
