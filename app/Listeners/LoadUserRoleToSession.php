<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Login;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class LoadUserRoleToSession
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  Login  $event
     * @return void
     */
    public function handle(Login $event)
    {
        // Put role in session if user has role to prevent frequent db access for role
        $userRole = \Auth::user()->access;
        if (\Auth::user()->access) {
            \Session::put('role', \Auth::user()->access->role);
        }
    }
}
