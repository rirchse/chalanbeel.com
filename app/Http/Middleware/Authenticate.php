<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string
     */
    protected function redirectTo($request)
    {
      if (! $request->expectsJson()) {
        if($request->is('admin') || $request->is('admin/*'))
        {
          return route('admin.login');
        }

        if($request->is('user') || $request->is('user/*'))
        {
          return route('user.login');
        }
        return route('login');
      }
    }
}
