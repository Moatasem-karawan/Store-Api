<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @param  string|null  ...$guards
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle($request, Closure $next)
    {
        if (auth('admin')->check()) {
            return redirect(RouteServiceProvider::HOME);
        }


        if (auth('owner')->check()) {
            return redirect(RouteServiceProvider::owner);
        }


        if (auth('seller_owner')->check()) {
            return redirect(RouteServiceProvider::seller);
        }


        if (auth('happy_owner')->check()) {
        return redirect(RouteServiceProvider::happy_seller);
    }



        return $next($request);
    }
}
