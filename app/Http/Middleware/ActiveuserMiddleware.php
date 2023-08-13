<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ActiveuserMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (auth("user_api")->user()->active_user=="0"){
            return response()->json(["state"=>false,"msg"=>"عذرا هذا الحساب غير مفعل"]);
        }
        return $next($request);
    }
}
