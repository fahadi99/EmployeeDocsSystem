<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckSpacePermission
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
        return checkPersonPermission('spaces-auto-2-' . $request->space_id)
            ? $next($request)
            : ErrorMessage();
    }
}
