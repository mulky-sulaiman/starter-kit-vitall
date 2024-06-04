<?php

namespace App\Livewire\Actions;

use App\Models\Permission;

class PermissionDelete
{
    /**
     * Log the current user out of the application.
     */
    public function __invoke(Permission $permission): bool
    {
        return $permission->delete();
    }
}
