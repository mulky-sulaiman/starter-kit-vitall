<?php

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use Livewire\Volt\Component;
use Livewire\Attributes\Validate;
use function Laravel\Folio\{middleware, name};

middleware(['guest']);
name('register');

new class extends Component {
    #[Validate('required')]
    public $name = '';

    #[Validate('required|email|unique:users')]
    public $email = '';

    #[Validate('required|min:8|same:passwordConfirmation')]
    public $password = '';

    #[Validate('required|min:8|same:password')]
    public $passwordConfirmation = '';

    #[Validate('required|boolean:true')]
    public $terms = false;

    public function register()
    {
        $this->validate();

        $user = User::create([
            'email' => $this->email,
            'name' => $this->name,
            'password' => Hash::make($this->password),
        ]);

        event(new Registered($user));

        Auth::login($user, true);

        return redirect()->intended('/');
    }
};

?>

<x-layouts.default :title="__('auth.register')">

    <x-ui.authentication-card>
        <x-slot name="logo">
            <x-ui.authentication-card-logo />
        </x-slot>

        @if (session('status'))
            <x-ui.authentication-status :status="session('status')" />
        @endif

        <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
            {{ __('register.title') }}
        </h1>
        @volt('auth.register')
            <form class="space-y-4 md:space-y-6" wire:submit="register" x-data x-init="$refs.name.focus()">
                <!-- Name -->
                <x-forms.input :label="__('register.name')" :hint="__('register.name_hint')" id="name" type="text" :placeholder="__('register.name_placeholder')"
                    wire:model="name" autofocus required x-ref="name" />
                <!-- Email -->
                <x-forms.input :label="__('register.email')" :hint="__('register.email_hint')" id="email" type="email" :placeholder="__('register.email_placeholder')"
                    wire:model="email" required />
                <!-- Password -->
                <x-forms.input :label="__('register.password')" :hint="__('register.password_hint')" type="password" id="password" name="password"
                    wire:model="password" required />
                <!-- Password Confirmation -->
                <x-forms.input :label="__('register.password_confirmation')" :hint="__('register.password_confirmation_hint')" type="password" id="password_confirmation"
                    name="password_confirmation" wire:model="passwordConfirmation" required />
                <!-- Consent ToS & PP -->
                <x-ui.tos-consent wire:model.checked="terms" required />
                <!-- Submit -->
                <x-ui.button-only type="submit" class="w-full">
                    <div class="flex items-center justify-center">
                        <x-tabler-user-plus class="w-6 h-6 mr-3" wire:loading.remove />
                        <x-ui.spinner class="mr-3" size="md" wire:loading />
                        <span>{{ __('register.register') }}</span>
                    </div>
                </x-ui.button-only>
                <!-- Login Link -->
                <p class="text-sm font-light text-gray-500 dark:text-gray-400">
                    {{ __('register.login_prefix') }}
                    <x-ui.link :href="route('login')"
                        class="font-medium text-primary-600 hover:underline dark:text-primary-500">
                        {{ __('register.login') }}</x-ui.link>
                </p>
            </form>
        @endvolt
    </x-ui.authentication-card>
</x-layouts.default>
