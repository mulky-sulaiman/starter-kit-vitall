<?php

namespace App\Livewire\Modals;

use Livewire\Attributes\On;
use Livewire\Component;

class DrawerModal extends Component
{
    public $viewingDrawer = false;
    public $target;
    public $arguments = [];
    public $maxWidth;
    public $placement;
    public $title;

    #[On('viewDrawer')]
    public function viewDrawer($target = null, $arguments=[], $maxWidth = null, $placement = null, $title = null)
    {
        $this->target = $target;
        $this->arguments = $arguments;
        if ($maxWidth) {
            $this->maxWidth = $maxWidth;
        }
        if ($placement) {
            $this->placement = $placement;
        }
        if ($title) {
            $this->title = $title;
        }

        $this->viewingDrawer = true;
    }

    #[On('hideDrawer')]
    public function hideDrawer()
    {
        $this->viewingDrawer = false;
        $this->reset(['viewingDrawer','target', 'arguments', 'maxWidth']);
    }

    public function render()
    {
        return view('livewire.modals.drawer-modal');
    }
}
