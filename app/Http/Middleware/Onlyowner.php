<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Onlyowner
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
        if (auth("owner_api")->user()){
            return response()->json(["state"=>false,"msg"=>"عذرا ليس لك صلاحية مستخدم انت لست مستخدم !"]);
        }
        return $next($request);
    }
}
