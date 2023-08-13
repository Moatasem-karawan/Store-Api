<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Onlyseller
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
        if (!auth("seller_api")->user()){
            return response()->json(["states"=>false,"msg"=>"عذرا ليس لك صلاحية تاجر انت لست تاجر !"]);
        }
        return $next($request);
    }
}
