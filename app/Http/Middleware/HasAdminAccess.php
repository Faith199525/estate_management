<?php

namespace App\Http\Middleware;

use Closure;

class HasAdminAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $permission)
    {
        if ($request->user()->hasPermission($permission)){
            return $next($request);
        }
        $request->session()->flash('error', 'You need authorization to view that page');
        return redirect('home');
    }
}
