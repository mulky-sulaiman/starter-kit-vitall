<x-ui.jet-drawer wire:model="viewingDrawer" :maxWidth="$maxWidth" :placement="$placement">
    {{-- <div class="p-3 offcanvas-header">
                <h2 class="offcanvas-title">{{ $title }}</h2>
                <button @click="$dispatch('hideDrawer')" type="button" type="button"
                    class="btn-close text-reset"></button>
            </div> --}}
    @if ($target)
        @livewire($target, $arguments)
    @endif
</x-ui.jet-drawer>
