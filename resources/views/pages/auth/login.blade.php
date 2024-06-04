<?php

use App\Models\User;
use Illuminate\Auth\Events\Login;
use function Laravel\Folio\{middleware, name};
use Livewire\Attributes\Validate;
use Livewire\Volt\Component;

middleware(['guest']);
name('login');

new class extends Component {
    #[Validate('required|email')]
    public string $email;

    #[Validate('required')]
    public string $password;

    public $remember = false;

    public function authenticate()
    {
        $this->validate();

        if (!Auth::attempt(['email' => $this->email, 'password' => $this->password], $this->remember)) {
            $this->addError('email', trans('auth.failed'));
            $this->reset(['password']);

            return;
        }

        event(new Login(auth()->guard('web'), User::where('email', $this->email)->first(), $this->remember));

        return $this->redirect('/', navigate: true);
    }
};

?>

<x-layouts.default :title="__('auth.login')">
    <x-slot name="head">
        <meta name="description" content="sikontol" />
    </x-slot>
    <x-ui.authentication-card>
        <x-slot name="logo">
            <x-ui.authentication-card-logo />
        </x-slot>

        @if (session('status'))
            <x-ui.authentication-status :status="session('status')" />
        @endif

        <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
            {{ __('login.title') }}
        </h1>
        @volt('auth.login')
            <form class="space-y-4 md:space-y-6" wire:submit="authenticate" x-data x-init="$refs.email.focus()">
                <!-- Email -->
                <x-forms.input :label="__('login.email')" :hint="__('login.email_hint')" id="email" type="email" :placeholder="__('login.email_placeholder')"
                    wire:model="email" autofocus required x-ref="email" />
                <!-- Password -->
                <x-forms.input :label="__('login.password')" :hint="__('login.password_hint')" type="password" id="password" name="password"
                    wire:model="password" required />
                <!-- Remember Me - Forgot Password Link-->
                <div class="flex items-center justify-between">
                    <x-forms.checkbox :label="__('login.remember_me')" id="remember" name="remember" wire:model="remember" />
                    <x-ui.text-link class="text-sm font-medium text-primary-600 hover:underline dark:text-primary-500"
                        href="{{ route('password.request') }}">{{ __('login.forgot_password') }}</x-ui.text-link>
                </div>
                <!-- Submit -->
                <x-ui.button-only type="submit" class="w-full">
                    <div class="flex items-center justify-center">
                        <x-tabler-login-2 class="w-6 h-6 mr-3" wire:loading.remove />
                        <x-ui.spinner class="mr-3" size="md" wire:loading />
                        <span>{{ __('login.login') }}</span>
                    </div>
                </x-ui.button-only>
                <!-- Register Link -->
                <p class="text-sm font-light text-gray-500 dark:text-gray-400">
                    {{ __('login.register_prefix') }}
                    <x-ui.link :href="route('register')" class="font-medium text-primary-600 hover:underline dark:text-primary-500">
                        {{ __('login.register') }}</x-ui.link>
                </p>
            </form>
        @endvolt
    </x-ui.authentication-card>
</x-layouts.default>
