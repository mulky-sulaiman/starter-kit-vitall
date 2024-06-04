<div>
    @if ($hasPayload)
        @if ($target)
            @livewire($target, $arguments)
        @endif
    @endif
</div>
