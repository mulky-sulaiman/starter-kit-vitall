<?php

namespace App\Livewire;

use Livewire\Attributes\On;
use Livewire\Component;

class Loader extends Component
{

    public bool $hasPayload;
    public string $target;
    public array $arguments = [];

    #[On('loadComponent')]
    public function load($target = null, $arguments = [])
    {
        $this->target = $target;
        $this->arguments = $arguments;
        $this->hasPayload = true;
    }

    #[On('unloadComponent')]
    public function unload()
    {
        $this->hasPayload = false;
        $this->reset(['target', 'arguments']);
    }

    public function render()
    {
        return view('livewire.loader');
    }
}
