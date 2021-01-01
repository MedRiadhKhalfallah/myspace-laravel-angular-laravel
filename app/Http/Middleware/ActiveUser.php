<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ActiveUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if(auth()->user()->getEtat()){
            return $next($request);
        }
        return response()->json([
            'message' => 'votre compte est desactivé',
            'error' => 'Unauthorized'
        ],401);
    }
}
