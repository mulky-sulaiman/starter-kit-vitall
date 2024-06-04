<?php

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;

use function Laravel\Folio\name;

use Livewire\Volt\Component;
use Livewire\Attributes\Validate;

name('password.reset');

new class extends Component {
    #[Validate('required')]
    public $token;

    #[Validate('required|email')]
    public $email;

    #[Validate('required|min:8|same:passwordConfirmation')]
    public $password;
    public $passwordConfirmation;

    #[Validate('required|boolean:true')]
    public $terms = false;

    public function mount($token)
    {
        $this->email = request()->query('email', '');
        $this->token = $token;
    }

    public function resetPassword()
    {
        $this->validate();

        $response = Password::broker()->reset(
            [
                'token' => $this->token,
                'email' => $this->email,
                'password' => $this->password,
            ],
            function ($user, $password) {
                $user->password = Hash::make($password);

                $user->setRememberToken(Str::random(60));

                $user->save();

                event(new PasswordReset($user));

                Auth::guard()->login($user);
            },
        );

        if ($response == Password::PASSWORD_RESET) {
            session()->flash(trans($response));

            return redirect('/');
        }

        $this->addError('email', trans($response));
    }
};

?>

<x-layouts.default :title="__('passwords.reset_password')">

    <x-ui.authentication-card>
        <x-slot name="logo">
            <x-ui.authentication-card-logo />
        </x-slot>

        <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
            {{ __('passwords.reset_password_title') }}
        </h1>

        <div class="mb-4 text-base font-normal text-gray-500 dark:text-gray-400">
            {{ __('passwords.reset_password_sub_title') }}
        </div>

        @volt('auth.password.token')
            <form class="space-y-4 md:space-y-6" wire:submit="resetPassword" x-data x-init="$refs.password.focus()">
                <!-- Email -->
                <x-forms.input :label="__('login.email')" :hint="__('login.email_hint')" id="email" type="email" :placeholder="__('login.email_placeholder')"
                    wire:model="email" required readonly />
                <!-- Password -->
                <x-forms.input :label="__('register.password')" :hint="__('register.password_hint')" type="password" id="password" name="password"
                    wire:model="password" x-ref="password" autofocus required />
                <!-- Password Confirmation -->
                <x-forms.input :label="__('register.password_confirmation')" :hint="__('register.password_confirmation_hint')" type="password" id="password_confirmation"
                    name="password_confirmation" wire:model="passwordConfirmation" required />
                <!-- Consent ToS & PP -->
                <x-ui.tos-consent wire:model.checked="terms" required />
                <!-- Submit -->
                <x-ui.button-only type="submit" class="w-full">
                    <div class="flex items-center justify-center">
                        <x-tabler-lock-cog class="w-6 h-6 mr-3" wire:loading.remove />
                        <x-ui.spinner class="mr-3" size="md" wire:loading />
                        <span class="truncate">{{ __('passwords.reset_password') }}</span>
                    </div>
                </x-ui.button-only>
            </form>
        @endvolt
    </x-ui.authentication-card>

</x-layouts.default>
