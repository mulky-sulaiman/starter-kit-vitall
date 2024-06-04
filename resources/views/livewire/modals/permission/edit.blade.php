<?php

use App\Models\Permission;
use Livewire\Attributes\Validate;
use Livewire\Volt\Component;
use App\Livewire\Forms\PermissionForm;

new class extends Component {
    public PermissionForm $form;
    public string $route;
    public string $mode = 'modal';

    public function mount(Permission $permission, string $mode)
    {
        $this->authorize('edit', $permission);
        $this->mode = $mode;
        $this->form->setPermission($permission);
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
        {{ __('Edit Permission #') . $form->permission->id }}
    </h5>
    <button type="button" @click="$dispatch('hideDrawer')"
        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 absolute top-2.5 end-2.5 flex items-center justify-center dark:hover:bg-gray-600 dark:hover:text-white">
        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
        </svg>
        <span class="sr-only">Close menu</span>
    </button>
    <form wire:submit="save" x-data x-init="$refs.name.focus()">
        <!-- Body -->
        <div x-bind:class="{ 'md:min-h-[92vh]': placement == 'left' || placement == 'right' }">
            <div class="space-y-4">
                <!-- Name -->
                <x-forms.input :label="__('Name')" id="name" type="text" :placeholder="__('{resource}.{action}.{target}')" wire:model="form.name"
                    autofocus required x-ref="name">
                    <x-slot name="hint">
                        <p class="my-4 font-semibold text-gray-900 text-md dark:text-white">
                            {{ __('Important notes for the Permission Name') }} :</p>
                        <ul
                            class="max-w-md space-y-1 text-justify text-gray-500 list-disc list-inside dark:text-gray-400">
                            <li>{{ __('Name construct the rules of the permission, with the convention of {resource}.{action}.{target}') }}
                            </li>
                            <li>{{ __('Example 1: \'users.create\' means the action is \'create\' for the resource (model) of \'users\'') }}
                            </li>
                            <li>{{ __('Example 2: \'system.access\' means the action is \'access\' for the resource (page) of \'system\'') }}
                            </li>
                            <li>{{ __('The first 2 words are mandatory, while the third word is an optional for more granular rule specific to the resource, i.e * for ALL targeted resources, or {id} of the targeted resource for specific ') }}
                            </li>
                            <li>{{ __('Permission\'s Title and Group will be automatically generated according to it\'s name') }}
                            </li>
                        </ul>
                    </x-slot>
                </x-forms.input>
            </div>

        </div>
        <!-- Footer -->
        <div class="flex items-center justify-center gap-x-3">
            <span class="w-full">
                <x-ui.button-only size="sm" class="w-full" type="button" variant="alternate"
                    @click="$dispatch('hideDrawer')">
                    <x-tabler-x class="w-4 h-4 me-2" />
                    <span class="truncate">Cancel</span>
                </x-ui.button-only>
            </span>
            <span class="w-full">
                <x-ui.button-only size="sm" class="w-full" type="submit" variant="primary">
                    <x-tabler-device-floppy class="w-4 h-4 me-2" />
                    <span class="truncate">Save</span>
                </x-ui.button-only>
            </span>
        </div>
    </form>
</div>
