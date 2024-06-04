<x-ui.jet-modal wire:model="viewingModal" :maxWidth="$maxWidth">
    {{-- <button @click="$dispatch('hideModal')" type="button" type="button" class="btn-close text-reset"></button> --}}
    @if ($target)
        @livewire($target, $arguments)
    @endif
</x-ui.jet-modal>
