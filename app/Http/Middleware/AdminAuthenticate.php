<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Auth\Middleware\Authenticate as Middleware;

class AdminAuthenticate extends Middleware
{
    protected function redirectTo($request){
        if (! $request->expectsJson()) {
            return route('admin.login');
        }
    }
    protected function authenticate($request, array $guards)
    {

        if ($this->auth->guard('admins')->check()) {
            return $this->auth->shouldUse('admins');
        }


        $this->unauthenticated($request, ['admins']);
    }
}
