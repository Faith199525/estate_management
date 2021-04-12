<?php

namespace App\Http\Middleware;

use Closure;

class CheckActivation
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $feature = '')
    {
        switch ($feature) {
            case 'MESSAGING_ACTIVATED':
                if (settings('MESSAGING_ACTIVATED')) {
                    return $next($request);
                }
                return back()->with('error', 'Messaging is not Activated!');
                break;
            case 'PAYMENT_ACTIVATED':
                if (settings('PAYMENT_ACTIVATED')) {
                    return $next($request);
                }
                return back()->with('error', 'Payment is not Activated!');
                break;
            default:
                return back();
                break;
        }
    }
}
