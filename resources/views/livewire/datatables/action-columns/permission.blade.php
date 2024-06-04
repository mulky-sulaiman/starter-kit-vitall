{{-- <button id="trigger-permission-{{ $permission->id }}" data-dropdown-toggle="permission-{{ $permission->id }}"
    class="inline-flex items-center p-2 text-sm font-medium text-center text-gray-900 bg-transparent rounded-lg hover:bg-gray-100 focus:ring-4 focus:outline-none dark:text-white focus:ring-gray-50 dark:hover:bg-gray-700 dark:focus:ring-gray-600"
    type="button" />
<div id="permission-{{ $permission->id }}"
        class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700 dark:divide-gray-600" />     --}}


<div x-data="{
    dropdownOpen: false
}" class="relative">
    <button @click="dropdownOpen=true"
        class="inline-flex items-center p-2 text-sm font-medium text-center text-gray-900 bg-transparent rounded-lg hover:bg-gray-100 focus:ring-4 focus:outline-none dark:text-white focus:ring-gray-50 dark:hover:bg-gray-700 dark:focus:ring-gray-600"
        type="button">
        <x-tabler-dots class="w-5 h-5" aria-hidden="true" fill="currentColor" />
    </button>
    <div x-show="dropdownOpen" @click.away="dropdownOpen=false" x-transition:enter="ease-out duration-200"
        x-transition:enter-start="-translate-y-2" x-transition:enter-end="translate-y-0" x-cloak
        class="absolute z-10 bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700 dark:divide-gray-600 ">
        <ul class="py-2 text-sm text-gray-700 dark:text-gray-200">
            @can('view', $permission)
                <li>
                    <a href="#" class="flex px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white"
                        @click.prevent="Livewire.dispatch('viewDrawer', { target: 'modals.permission.show', arguments: { permission: {{ $permission->id }}, mode: 'drawer' }, placement: 'right'})">
                        <x-tabler-eye class="w-4 h-4 mr-2" />
                        <span>{{ __('View') }}</span>
                    </a>
                </li>
            @endcan
            @can('updateAny', $permission)
                <li>
                    <a href="#" class="flex px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white"
                        @click.prevent="Livewire.dispatch('viewDrawer', { target: 'modals.permission.edit', arguments: { permission: {{ $permission->id }}, mode: 'drawer' }, placement: 'right'})">
                        <x-tabler-edit class="w-4 h-4 mr-2" />
                        <span>{{ __('Edit') }}</span>
                    </a>
                </li>
            @endcan
            @can('deleteAny', $permission)
                <li>
                    <a href="#" class="flex px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white"
                        data-modal-target="confirm-dialog-modal" data-modal-toggle="confirm-dialog-modal"
                        x-on:click.prevent="set('warning', 'sm', true, '{{ __('Permission Delete') }}', '{{ __('Are you sure you want to delete this permission?') }}', '{{ __('This action can not be undone') }}', true, '{{ __('No, Cancel') }}', true, '{{ __('Yes, Proceed') }}', '', 'confirmed-permission-delete-{{ $permission->id }}')"
                        x-on:confirmed-permission-delete-{{ $permission->id }}.window="$dispatch('loadComponent', { target: 'permission.delete', arguments: { permission: {{ $permission->id }}}})">
                        <x-tabler-trash class="w-4 h-4 mr-2" />
                        <span>{{ __('Delete') }}</span>
                    </a>
                </li>
            @endcan
        </ul>
    </div>
</div>
