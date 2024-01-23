<?php

namespace App\Http\Middleware;

use App\Models\PersonRight;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CheckUserLoggin
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
        if (auth()->check() ) {
            $memberId = Auth::user()->id;
            Session::put('rights', PersonRight::getRightString($memberId));
            return $next($request);
        }
        return ErrorMessageForCheckLoginUser();
    }
}
