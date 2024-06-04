<?php

namespace App\Livewire\Permission;

use Livewire\Attributes\{On};
use App\Livewire\Actions\{PermissionDelete, PermissionRestore};
use Livewire\Component;
use App\Models\Permission;
use Masmerise\Toaster\Toaster;

class Delete extends Component
{
    public $permission;
    public String $route;

    public function mount(int $permission, PermissionDelete $permissionDelete, PermissionRestore $permissionRestore)
    {
        $permission = Permission::findOrFail($permission);
        $this->authorize('delete', $permission);
        $this->permission = $permission;
        $this->route = url()->previous();
        if (str_contains($this->route, '?')) {
            $exploded = explode('?', $this->route);
            $this->route = $exploded[0];
        }

        if ($permissionDelete($this->permission)) {
            Toaster::success(__('Selected permission has been deleted'));
        } else {
            Toaster::error(__('Something is wrong, We can not delete this permission'));
        }

        // if (empty($this->permission->deleted_at)) {
        //     if ($permissionDelete($this->permission)) {
        //         Toaster::success(__('Selected permission has been deleted'));
        //     } else {
        //         Toaster::error(__('Something is wrong, We can not delete this permission'));
        //     }
        // } else {
        //     if ($permissionRestore($this->permission)) {
        //         Toaster::success(__('Selected permission has been restored'));
        //     } else {
        //         Toaster::error(__('Something is wrong, We can not restore this permission'));
        //     }
        // }

        // $this->dispatch('close');
        $this->redirectIntended($this->route, navigate: true);
        return $this->dispatch('unloadComponent');
    }
}
