<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class UserAuth {
  public function handle($request, Closure $next)
  {
  //   if (Auth::check()) {
  //     return $next($request);
  //   }
  //   return redirect('/');
  // }
      $role = $this->CekRoute($request->route());
      $role_auth = isset(Auth::user()->role) ? Auth::user()->role : null;
      if ($role_auth == $role) {
         return $next($request);
      }
      return redirect('/');
  }

    private function CekRoute($routes)
    {
        $route = $routes->getAction();
        return isset($route['roles']) ? $route['roles'] : null;
    }
}
