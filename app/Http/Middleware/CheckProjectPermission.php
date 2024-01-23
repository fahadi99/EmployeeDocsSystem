<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckProjectPermission
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
        return checkPersonPermission('projects-auto-1-' . $request->project_id)
            ? $next($request)
            : ErrorMessage();
    }
}
