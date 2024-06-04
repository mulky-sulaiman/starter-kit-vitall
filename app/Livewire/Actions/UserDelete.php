<?php

namespace App\Livewire\Actions;

use App\Models\User;

class UserDelete
{
    /**
     * Log the current user out of the application.
     */
    public function __invoke(User $user): bool
    {
        return $user->delete();
    }
}
