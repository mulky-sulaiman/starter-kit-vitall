<?php

use App\Models\Permission;
use Livewire\Attributes\Validate;
use Livewire\Volt\Component;
use App\Livewire\Forms\PermissionForm;

new class extends Component {
    public $permission;
    public string $route;
    public string $mode = 'modal';

    public function mount(Permission $permission, string $mode)
    {
        $this->authorize('edit', $permission);
        $this->mode = $mode;
        $this->permission = $permission;
        $this->route = url()->previous();
    }

    public function save()
    {
        $this->authorize('edit', $this->form->permission);
        $this->form->update();
        // session()->flash('success', __('New Permission has been added : ') . $this->form->name);
        // $this->dispatch('hideModal');
        Toaster::success(__('Permission has been updated'));
        return $this->redirectIntended($this->route, navigate: true);
    }
};
?>

<div>
    <!-- Header -->
    <h5 id="drawer-label"
        class="inline-flex items-center mb-4 text-base font-semibold tracking-widest uppercase text-primary-500 dark:text-primary-400">
        {{ __('View Permission #') . $permission->id }}
    </h5>
    <button type="button" @click="$dispatch('hideDrawer')"
        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 absolute top-2.5 end-2.5 flex items-center justify-center dark:hover:bg-gray-600 dark:hover:text-white">
        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
        </svg>
        <span class="sr-only">Close menu</span>
    </button>
    <!-- Body -->
    <div x-bind:class="{ 'md:min-h-[92vh]': placement == 'left' || placement == 'right' }">
        <div class="space-y-4">
            <div class="grid grid-cols-none gap-4">
                <div>
                    <x-forms.placeholder :label="__('Name')" :title="$permission->name" class="required" />
                </div>
                <div>
                    <x-forms.placeholder :label="__('Label')" :title="$permission->label" />
                </div>
                <div>
                    <x-forms.placeholder :label="__('Group')" :title="$permission->group" />
                </div>
            </div>
        </div>

    </div>
    <!-- Footer -->
    <div class="flex items-center justify-center gap-x-3">
        <span class="w-full">
            <x-ui.button-only size="sm" class="w-full" type="button" variant="alternate"
                @click="$dispatch('hideDrawer')">
                <span class="truncate">Close</span>
            </x-ui.button-only>
        </span>

    </div>
</div>
