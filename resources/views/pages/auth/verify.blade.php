<?php

use Illuminate\Auth\Events\Verified;
use Illuminate\Support\Facades\Auth;
use function Laravel\Folio\{middleware, name};
use Livewire\Volt\Component;

middleware(['auth', 'throttle:6,1']);
name('verification.notice');

new class extends Component {
    public function resend()
    {
        $user = auth()->user();
        if ($user->hasVerifiedEmail()) {
            redirect('/');
        }

        $user->sendEmailVerificationNotification();

        event(new Verified($user));

        $this->dispatch('resent');
        session()->flash('resent');
    }
};

?>

<x-layouts.default :title="__('auth.verify_email')">

    <x-ui.authentication-card>
        <x-slot name="logo">
            <x-ui.authentication-card-logo />
        </x-slot>

        <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
            {{ __('auth.verify_email_title') }}
        </h1>

        <div class="mb-4 text-base font-normal text-gray-500 dark:text-gray-400">
            {{ __('auth.verify_email_sub_title') }}
        </div>
        @volt('auth.verify')
            @if (session('resent'))
                <div class="mb-4 text-sm font-medium text-success-600 dark:text-success-400">
                    {{ __('auth.verification_link_sent') }}
                </div>
            @endif

            <form @submit.prevent="resend">
                <x-ui.button-only type="submit" class="w-full">
                    <x-tabler-mail class="w-6 h-6 mr-3" wire:loading.remove />
                    <x-ui.spinner class="w-5 h-5 mr-3 text-white dark:text-white" wire:loading />
                    <span class="truncate">{{ __('auth.resend_verify_email') }}</span>
                </x-ui.button-only>
                <div class="flex items-center justify-between mt-4">
                    <x-ui.link :href="route('profile.edit')"
                        class="text-sm text-gray-600 underline rounded-md dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
                        {{ __('auth.edit_profile') }}</x-ui.link>
                    <a href="{{ route('logout') }}" data-modal-target="confirm-dialog-modal"
                        data-modal-toggle="confirm-dialog-modal"
                        x-on:click.prevent="set('warning', 'sm', true, '{{ __('Logout') }}', '{{ __('We are going to log you out') }}', '{{ __('Are you sure you want to log out?') }}', true, '{{ __('No, Cancel') }}', true, '{{ __('Yes, Proceed') }}', '', 'confirmed-logout-03')"
                        x-on:confirmed-logout-03.window="$dispatch('loadComponent', { target: 'auth.logout', arguments: {}})"
                        class="text-sm text-gray-600 underline rounded-md dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800 ms-2">
                        {{ __('auth.logout') }}
                    </a>
                </div>
            </form>
        @endvolt
    </x-ui.authentication-card>
</x-layouts.default>
