<?php

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;
use function Laravel\Folio\{middleware, name};
use Illuminate\Validation\Rule;
use Livewire\Volt\Component;
use Livewire\Attributes\Validate;
use Livewire\Attributes\Locked;
use Illuminate\Auth\Events\Verified;

name('profile.edit');
middleware(['auth']);

new class extends Component {
    #[Locked]
    public $user;

    public $name = '';
    public $email = '';
    public $current_password = '';

    #[Validate('required|confirmed|min:6')]
    public $new_password = '';
    public $new_password_confirmation = '';
    public $delete_confirm_password = '';

    public function mount()
    {
        $this->user = auth()->user();
        $this->name = $this->user->name;
        $this->email = $this->user->email;
    }

    /**
     * Send an email verification notification to the current user.
     */
    public function sendVerification(): void
    {
        $user = Auth::user();

        if ($user->hasVerifiedEmail()) {
            $this->redirectIntended(default: RouteServiceProvider::HOME);

            return;
        }

        $user->sendEmailVerificationNotification();

        Session::flash('status', 'verification-link-sent');
    }

    public function updateProfile()
    {
        $validated = $this->validate([
            'name' => 'required|string|min:3',
            'email' => 'required|min:3|email|max:255|unique:users,email,' . $this->user->id . ',id',
        ]);

        // if the user hasn't changed their name or email and we also want to make, don't update and show error
        if ($this->user->name == $this->name && $this->user->email == $this->email) {
            $this->dispatch('toast', message: 'Nothing to update.', data: ['position' => 'top-right', 'type' => 'info']);
            return;
        }

        $this->user->fill(['email' => $this->email, 'name' => $this->name])->save();

        $this->dispatch('toast', message: 'Successfully updated profile.', data: ['position' => 'top-right', 'type' => 'success']);
    }

    public function updatePassword()
    {
        $validated = $this->validate();

        if (!Hash::check($this->current_password, $this->user->password)) {
            $this->dispatch('toast', message: 'Current Password Incorrect', data: ['position' => 'top-right', 'type' => 'danger']);
            return;
        }

        $this->dispatch('toast', message: 'Successfully updated password.', data: ['position' => 'top-right', 'type' => 'success']);
        $this->user->fill(['password' => Hash::make($this->new_password), 'remember_token' => Str::random(60)])->save();

        $this->reset(['current_password', 'new_password', 'new_password_confirmation']);
    }

    public function destroy()
    {
        if (!Hash::check($this->delete_confirm_password, $this->user->password)) {
            $this->dispatch('toast', message: 'The Password you entered is incorrect', data: ['position' => 'top-right', 'type' => 'danger']);
            $this->reset(['delete_confirm_password']);
            return;
        }

        $user = auth()->user();

        Auth::logout();

        $user->delete();

        request()->session()->invalidate();
        request()->session()->regenerateToken();

        return Redirect::to('/');
    }
};

?>


<x-layouts.app>

    <x-slot name="header">
        <h2 class="text-lg font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    @volt('profile.edit')
        <div class="pb-5">
            <div class="mx-auto space-y-6">

                {{-- Update Profile Section --}}
                <section
                    class="p-4 bg-white shadow sm:p-8 dark:bg-gray-800 sm:rounded-lg dark:bg-gray-900/50 dark:border dark:border-gray-200/10">
                    <div class="max-w-xl">
                        <header>
                            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">{{ __('Profile Information') }}
                            </h2>
                            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                {{ __("Update your account's profile information and email address.") }}</p>
                        </header>
                        <form wire:submit="updateProfile" class="mt-6 space-y-6" x-data x-init="$refs.name.focus()">
                            <!-- Name -->
                            <x-forms.input :label="__('register.name')" :hint="__('register.name_hint')" id="name" type="text"
                                :placeholder="__('register.name_placeholder')" wire:model="name" autofocus x-ref="name" />
                            <!-- Email -->
                            <x-forms.input :label="__('login.email')" :hint="__('login.email_hint')" id="email" type="email"
                                :placeholder="__('login.email_placeholder')" wire:model="email" />

                            @if (auth()->user() instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && !auth()->user()->hasVerifiedEmail())
                                <div>
                                    <p class="mt-2 text-sm text-gray-800 dark:text-gray-200">
                                        {{ __('Your email address is unverified.') }}

                                        <button wire:click.prevent="sendVerification"
                                            class="text-sm text-gray-600 underline rounded-md dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
                                            {{ __('Click here to re-send the verification email.') }}
                                        </button>
                                    </p>

                                    @if (session('status') === 'verification-link-sent')
                                        <p class="mt-2 text-sm font-medium text-success-600 dark:text-success-400">
                                            {{ __('A new verification link has been sent to your email address.') }}
                                        </p>
                                    @endif
                                </div>
                            @endif

                            <div class="flex items-start">
                                <div>
                                    <x-ui.button-only type="submit" size="sm" wire:target="updateProfile">
                                        <div class="flex items-center justify-center">
                                            <x-tabler-device-floppy class="w-6 h-6 mr-3" wire:loading.remove
                                                wire:target="updateProfile" />
                                            <x-ui.spinner class="mr-3" size="md" wire:loading
                                                wire:target="updateProfile" />
                                            <span>{{ __('Update') }}</span>
                                        </div>
                                    </x-ui.button-only>
                                </div>
                            </div>
                        </form>
                    </div>
                </section>
                {{-- End Update Profile Information --}}

                {{-- Update Password Section --}}
                <section
                    class="p-4 bg-white shadow sm:p-8 dark:bg-gray-800 sm:rounded-lg dark:bg-gray-900/50 dark:border dark:border-gray-200/10">
                    <div class="max-w-xl">
                        <header>
                            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">{{ __('Update Password') }}
                            </h2>
                            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                {{ __('Ensure your account is using a long, random password to stay secure.') }}</p>
                        </header>
                        <form wire:submit="updatePassword" class="mt-6 space-y-6">
                            <!-- Current Password -->
                            <x-forms.input :label="__('register.current_password')" :hint="__('register.current_password_hint')" type="password" id="current_password"
                                name="current_password" wire:model="current_password" />
                            <!-- New Password -->
                            <x-forms.input :label="__('register.new_password')" :hint="__('register.new_password_hint')" type="password" id="new_password"
                                name="new_password" wire:model="new_password" />
                            <!-- New Password Confirmation -->
                            <x-forms.input :label="__('register.new_password_confirmation')" :hint="__('register.new_password_confirmation_hint')" type="password"
                                id="new_password_confirmation" name="new_password_confirmation"
                                wire:model="new_password_confirmation" />


                            {{-- <x-ui.input label="Current Password" type="password" id="current_password"
                                name="current_password" wire:model="current_password" />
                            <x-ui.input label="New Password" type="password" id="new_password" name="new_password"
                                wire:model="new_password" />
                            <x-ui.input label="Confirm New Password" type="password" id="new_password_confirmation"
                                name="new_password_confirmation" wire:model="new_password_confirmation" /> --}}

                            <div class="flex items-start">
                                <div>
                                    {{-- <x-ui.button type="primary" submit="true">{{ __('Update') }}</x-ui.button> --}}
                                    <x-ui.button-only type="submit" size="sm" wire:target="updatePassword">
                                        <div class="flex items-center justify-center">
                                            <x-tabler-device-floppy class="w-6 h-6 mr-3" wire:loading.remove
                                                wire:target="updatePassword" />
                                            <x-ui.spinner class="mr-3" size="md" wire:loading
                                                wire:target="updatePassword" />
                                            <span>{{ __('Update') }}</span>
                                        </div>
                                    </x-ui.button-only>
                                </div>
                            </div>
                        </form>
                    </div>
                </section>
                {{-- End Update Password Section --}}

                <div
                    class="p-4 bg-white shadow sm:p-8 dark:bg-gray-800 sm:rounded-lg dark:bg-gray-900/50 dark:border dark:border-gray-200/10">
                    <div class="max-w-xl">

                        {{-- Delete User Form --}}
                        <section class="space-y-6">
                            <header>
                                <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">{{ __('Delete Account') }}
                                </h2>
                                <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                    {{ __('After deleting your account, all data and resources are permanently removed. Enter your password to confirm deletion.') }}
                                </p>
                            </header>

                            <div class="flex items-start justify-start w-auto text-left">
                                <div>
                                    {{-- <x-ui.button type="danger" x-data
                                        @click.prevent="$dispatch('open-modal', 'confirm-user-deletion')">
                                        {{ __('Delete Account') }}
                                    </x-ui.button> --}}
                                    <x-ui.button-only type="button" variant="danger" size="sm"
                                        @click.prevent="$dispatch('open-modal', 'confirm-user-deletion')">
                                        <div class="flex items-center justify-center">
                                            <x-tabler-trash class="w-6 h-6 mr-3" />
                                            <span>{{ __('Delete Account') }}</span>
                                        </div>
                                    </x-ui.button-only>
                                </div>
                            </div>

                            <x-ui.modal name="confirm-user-deletion" maxWidth="lg" :show="$errors->userDeletion->isNotEmpty()" focusable>
                                <form wire:submit="destroy" class="p-6">

                                    <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                        {{ __('Are you sure you want to delete your account?') }}</h2>
                                    <p class="mt-1 mb-6 text-sm text-gray-600 dark:text-gray-400">
                                        {{ __('After deleting your account, all data and resources are permanently removed. Enter your password to confirm deletion.') }}
                                    </p>

                                    {{-- <x-ui.input label="Password" type="password" id="delete_confirm_password"
                                        name="delete_confirm_password" wire:model="delete_confirm_password" /> --}}

                                    <!-- Current Password -->
                                    <x-forms.input :label="__('login.password')" :hint="__('login.password_hint')" type="password"
                                        id="delete_confirm_password" name="delete_confirm_password"
                                        wire:model="delete_confirm_password" autofocus required />

                                    <div class="flex justify-end mt-6">
                                        <div>
                                            {{-- <x-ui.button type="secondary" x-on:click="$dispatch('close')">
                                                {{ __('Cancel') }}
                                            </x-ui.button> --}}

                                            <x-ui.button-only type="button" variant="light" size="sm"
                                                x-on:click="$dispatch('close')">
                                                <div class="flex items-center justify-center">
                                                    <span>{{ __('Cancel') }}</span>
                                                </div>
                                            </x-ui.button-only>

                                        </div>

                                        <div class="ml-3">
                                            {{-- <x-ui.button type="danger" submit="true">
                                                {{ __('Delete Account') }}
                                            </x-ui.button> --}}
                                            <x-ui.button-only type="submit" variant="danger" size="sm"
                                                wire:target="destroy">
                                                <div class="flex items-center justify-center">
                                                    <x-tabler-trash class="w-6 h-6 mr-3" wire:loading.remove
                                                        wire:target="destroy" />
                                                    <x-ui.spinner class="mr-3" size="md" wire:loading
                                                        wire:target="destroy" />
                                                    <span>{{ __('Delete Account') }}</span>
                                                </div>
                                            </x-ui.button-only>
                                        </div>
                                    </div>
                                </form>
                            </x-ui.modal>
                        </section>
                        {{-- End Delete User Form --}}

                    </div>
                </div>
            </div>
        </div>
    @endvolt

</x-layouts.app>
