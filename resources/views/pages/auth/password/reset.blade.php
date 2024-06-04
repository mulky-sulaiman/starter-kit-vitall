<?php

use Illuminate\Support\Facades\Password;
use function Laravel\Folio\name;
use Livewire\Volt\Component;
use Livewire\Attributes\Validate;

name('password.request');

new class extends Component {
    #[Validate('required|email')]
    public $email = null;
    #[Validate('required|boolean:true')]
    public $terms = false;

    public $emailSentMessage = false;

    public function sendResetPasswordLink()
    {
        $this->validate();

        $response = Password::broker()->sendResetLink(['email' => $this->email]);

        if ($response == Password::RESET_LINK_SENT) {
            $this->emailSentMessage = trans($response);

            return;
        }

        $this->addError('email', trans($response));
    }
};

?>



<x-layouts.default :title="__('auth.forgot_password')">
    <x-ui.authentication-card>
        <x-slot name="logo">
            <x-ui.authentication-card-logo />
        </x-slot>

        <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
            {{ __('passwords.forgot_password_title') }}
        </h1>
        <div class="mb-4 text-base font-normal text-gray-500 dark:text-gray-400">
            {{ __('passwords.forgot_password_sub_title') }}
        </div>
        @volt('auth.password.reset')
            <div>
                @if ($emailSentMessage)
                    <x-ui.authentication-status :status="$emailSentMessage" />
                @endif

                <form class="space-y-4 md:space-y-6" wire:submit="sendResetPasswordLink" x-data x-init="$refs.email.focus()">
                    <!-- Email -->
                    <x-forms.input :label="__('login.email')" :hint="__('login.email_hint')" id="email" type="email" :placeholder="__('login.email_placeholder')"
                        wire:model="email" autofocus required x-ref="email" :success="$emailSentMessage" />
                    <!-- Consent ToS & PP -->
                    <x-ui.tos-consent wire:model.checked="terms" required />
                    <!-- Submit -->
                    <x-ui.button-only type="submit" class="w-full">
                        <div class="flex items-center justify-center">
                            <x-tabler-mail class="w-6 h-6 mr-3" wire:loading.remove />
                            <x-ui.spinner class="mr-3" size="md" wire:loading />
                            <span class="truncate">{{ __('passwords.email_forgot_password_link') }}</span>
                        </div>
                    </x-ui.button-only>
                </form>
                <!-- Login Link -->
                <p class="mt-6 text-sm font-light text-gray-500 dark:text-gray-400">
                    {{ __('auth.forgot_password_login_prefix') }}
                    <x-ui.link :href="route('login')" class="font-medium text-primary-600 hover:underline dark:text-primary-500">
                        {{ __('auth.forgot_password_login') }}</x-ui.link>
                </p>
            </div>
        @endvolt
    </x-ui.authentication-card>
</x-layouts.default>
