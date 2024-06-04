<?php

use function Laravel\Folio\{middleware, name};
use Livewire\Volt\Component;

name('permission.index');
middleware(['auth']);

new class extends Component {
    public function mount()
    {
    }
};
?>

<x-layouts.app :title="__('Permission List')">
    <x-slot name="head">
        <meta name="description" :content="__('Permission List')" />
        <!-- Adds the Core Table Styles -->
        @rappasoftTableStyles
        <!-- Adds any relevant Third-Party Styles (Used for DateRangeFilter (Flatpickr) and NumberRangeFilter) -->
        @rappasoftTableThirdPartyStyles
        <!-- Adds the Core Table Scripts -->
        @rappasoftTableScripts
        <!-- Adds any relevant Third-Party Scripts (e.g. Flatpickr) -->
        @rappasoftTableThirdPartyScripts
    </x-slot>
    <x-slot name="header">
        <div class="flex items-center justify-between sm:flex md:divide-x md:divide-gray-100 dark:divide-gray-700">
            <h2 class="text-lg font-semibold leading-tight text-gray-800 dark:text-gray-200">
                {{ __('Permission List') }}
            </h2>
            <x-ui.button-only type="button" variant="primary" size="sm" rounded="lg"
                onclick="Livewire.dispatch('viewDrawer', { target: 'modals.permission.create', arguments: { mode: 'drawer' }, placement: 'right'})">
                <x-tabler-plus class="w-4 h-4 md:me-2" />
                <span class="hidden md:block">{{ __('Add New Permission') }}</span>
            </x-ui.button-only>
        </div>
    </x-slot>

    @volt('permissions.index')
        <div class="flex flex-col items-stretch flex-1 h-100">
            <div class="flex flex-col items-stretch flex-1 pb-5 mx-auto h-100 min-h-[500px] w-full">
                <div class="relative flex-1 w-full h-100">
                    <livewire:datatables.permissiondatatable />
                </div>
            </div>
        </div>
    @endvolt
</x-layouts.app>
