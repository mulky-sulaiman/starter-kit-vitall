<?php

namespace App\Livewire\Auth;

use App\Livewire\Actions\Logout as ActionLogout;
use Livewire\Component;


class Logout extends Component
{
    public $user;
    public String $route;

    public function mount(ActionLogout $logout): void
    {
        $logout();
        $this->redirect(route('home'), navigate: true);
    }
}
