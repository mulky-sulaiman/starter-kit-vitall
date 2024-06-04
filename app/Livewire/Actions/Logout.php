<?php

namespace App\Livewire\Actions;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class Logout
{
    /**
     * Log the current user out of the application.
     */
    public function __invoke(): void
    {
        // Log the user logout time
        // activity('logout')
        //     ->causedBy(Auth::user())
        //     ->log('USER Logout : ' . Auth::user()->username);

        Auth::guard('web')->logout();


        Session::invalidate();
        Session::regenerateToken();
    }
}
