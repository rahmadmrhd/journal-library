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
    $user = Auth::user();
    $rulesUser = $user->roles->pluck('slug')->toArray();

    //lakukan pengecekan apakah daftar roles yang diizinkan ditemukan pada daftar roles user
    if (count(array_intersect($rulesUser, $role_name)) > 0) {
      /**
       * @disregard 
       */
      if (!in_array($user->getCurrentRole()->slug, $role_name)) {
        $request->request->add([
          'role_error' => [
            'url_back' => URL::previous(),
          ],
        ]);
      }
      return $next($request);
    }
    return abort(404);
  }
}
