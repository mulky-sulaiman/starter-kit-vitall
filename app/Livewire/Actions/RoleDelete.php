<?php

namespace App\Livewire\Actions;

use App\Models\Role;

class RoleDelete
{
    /**
     * Log the current user out of the application.
     */
    public function __invoke(Role $role): bool
    {
        return $role->delete();
    }
}
