<?php

namespace App\Livewire\Modals;

use Livewire\Attributes\On;
use Livewire\Component;

class PopUpModal extends Component
{
    public $viewingModal = false;
    public $target;
    public $arguments = [];
    public $maxWidth;

    #[On('viewModal')]
    public function viewModal($target = null, $arguments = [], $maxWidth = null)
    {
        $this->target = $target;
        $this->arguments = $arguments;
        if ($maxWidth) {
            $this->maxWidth = $maxWidth;
        }
        $this->viewingModal = true;
    }

    #[On('hideModal')]
    public function hideModal()
    {
        $this->viewingModal = false;
        $this->reset(['viewingModal','target', 'arguments', 'maxWidth']);
    }

    public function render()
    {
        return view('livewire.modals.pop-up-modal');
    }
}
