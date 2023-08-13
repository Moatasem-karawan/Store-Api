<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Support\Facades\Request;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        if (!$request->expectsJson()) {
            if (Request::is( '/index')) {
                return route('login');
            }
            if (Request::is( '/owner')) {
                return route('login');
            }
            if (Request::is( '/seller')) {
                return route('login');
            }
            if (Request::is( '/happy_seller')) {
                return route('login');
            }


        }
    }
}
