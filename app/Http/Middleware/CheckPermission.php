<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CheckPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, $permissionName)
    {
        if (!$request->user() || !$request->user()->permissions()->where('name', $permissionName)->exists()) {
            Session::flash('alert', 'You do not have permission to view this page.');
            return redirect()->back();
        }

        return $next($request);
    }
}
