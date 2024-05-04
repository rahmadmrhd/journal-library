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
  public function handle(Request $request, Closure $next, string $role_name): Response {
    $role = Role::where('slug', "=", $role_name)->first();
    $user = Auth::user();
    if ($user->roles->pluck('id')->contains($role->id) || $user->current_role_id == $role->id) {
      if ($user->current_role_id != $role->id) {
        $request->request->add([
          'role_error' => [
            'url_back' => URL::previous(),
            'right_role' => $role,
          ],
        ]);
      }
      return $next($request);
    }
    return abort(404);
  }
}
