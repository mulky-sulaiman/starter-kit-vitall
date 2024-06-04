<?php

use function Laravel\Folio\name;
use Livewire\Volt\Component;
use Livewire\Attributes\Validate;

name('password.confirm');

new class extends Component {
    #[Validate('required|current_password')]
    public $password = '';
    #[Validate('required|boolean:true')]
    public $terms = false;

    public function confirm()
    {
        $this->validate();

        session()->put('auth.password_confirmed_at', time());

        return redirect()->intended('/');
    }
};

?>

<x-layouts.default :title="__('passwords.confirm_password_title')">

    <x-ui.authentication-card>
        <x-slot name="logo">
            <x-ui.authentication-card-logo />
        </x-slot>

        <h1 class="text-xl font-bold leading-tight tracking-tight text-danger-700 md:text-2xl dark:text-danger-600">
            {{ __('passwords.confirm_password_title') }}
        </h1>

        <div class="mb-4 text-base font-normal text-justify text-gray-500 dark:text-gray-400">
            {{ __('passwords.confirm_password_sub_title') }}
        </div>

        <div class="flex items-center justify-center">
            <div class="">
                <img class="mb-4 rounded-lg w-28 h-28 sm:mb-0 xl:mb-4 2xl:mb-0"
                    src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name) }}&color=7F9CF5&background=EBF4FF'"
                    alt="{{ auth()->user()->name }}">
                <div class="w-full mx-auto mt-4 text-center">
                    <p class="text-lg font-medium text-gray-900 font-base dark:text-white">{{ auth()->user()->name }}
                    </p>
                    <p class="text-sm text-gray-500 dark:text-gray-200">{{ auth()->user()->email }}</p>
                </div>
            </div>
        </div>

        @volt('auth.password.confirm')
            <form class="space-y-4 md:space-y-6" wire:submit="confirm" x-data x-init="$refs.password.focus()">
                <!-- Password -->
                <x-forms.input :label="__('login.password')" :hint="__('login.password_hint')" type="password" id="password" name="password"
                    wire:model="password" autofocus required x-ref="password" />
                <!-- Forgot Password Link-->
                <div class="flex items-center justify-between">
                    <x-ui.text-link class="text-sm font-medium text-primary-600 hover:underline dark:text-primary-500"
                        href="{{ route('password.request') }}">{{ __('login.forgot_password') }}</x-ui.text-link>
                </div>
                <!-- Consent ToS & PP -->
                <x-ui.tos-consent wire:model.checked="terms" required />
                <!-- Submit -->
                <x-ui.button-only type="submit" variant="danger" class="w-full">
                    <div class="flex items-center justify-center">
                        <x-tabler-lock-open class="w-6 h-6 mr-3" wire:loading.remove />
                        <x-ui.spinner class="mr-3" size="md" wire:loading />
                        <span class="truncate">{{ __('passwords.confirm_password') }}</span>
                    </div>
                </x-ui.button-only>
            </form>
        @endvolt
    </x-ui.authentication-card>

</x-layouts.default>
