@props([
    'label' => null,
    'id' => null,
    'name' => null,
    'type' => 'text',
    'prefix' => null,
    'suffix' => null,
    'hint' => null,
    'success' => null,
])

@php
    $wireModel = $attributes->get('wire:model');
    $required = $attributes->get('required') ? true : false;
    $disabled = $attributes->get('disabled') ? true : false;
    $readonly = $attributes->get('readonly') ? true : false;
    $autofocus = $attributes->get('autofocus') ? true : false;
    $isSuccess = $success != null ? true : false;
@endphp

@if ($type == 'password')
    <div x-data="{ showPassword: false, dirty: false, success: {{ $isSuccess ? 'true' : 'false' }}, required: {{ $required ? 'true' : 'false' }}, error: {{ $errors->has($wireModel) ? 'true' : 'false' }} }" class="mb-4">
        @if ($label)
            <!-- Label -->
            <label for="{{ $id ?? '' }}"
                class="label @if ($isSuccess) label-is-valid @endif @error($wireModel) label-is-invalid @enderror"
                wire:dirty.class="label-is-dirty" wire:target="{{ $wireModel }}"
                x-bind:class="{ 'required': required }">
                {{ $label }}
            </label>
        @endif
        <!-- Input Block -->
        <div class="relative">
            <div class="relative">
                @if ($prefix)
                    <!-- Prefix -->
                    <div class="absolute inset-y-0 flex items-center start-0 ps-3">
                        {{ $prefix }}
                    </div>
                @endif
                <!-- Main -->
                <div data-model="{{ $wireModel }}">
                    <input id="{{ $id ?? '' }}" name="{{ $name ?? '' }}"
                        x-bind:type="showPassword ? 'text' : 'password'" placeholder="••••••••"
                        x-on:keydown="dirty=true;error=false;success=false;"
                        class="input @if ($isSuccess) is-valid @endif @error($id) is-invalid @enderror @if ($disabled || $readonly) cursor-not-allowed' @endif}} {{ $prefix ? 'ps-10' : '' }} {{ $suffix ? 'pe-10' : '' }}"
                        {{ $attributes->whereStartsWith('wire:model') }} {{ $attributes }}
                        {{ $autofocus ? 'autofocus' : '' }} {{ $required ? 'required' : '' }}
                        wire:dirty.class="is-dirty" />
                </div>
                <!-- Suffix -->
                <div class="absolute inset-y-0 flex items-center end-0 pe-3">
                    <div class="flex items-center justify-center">
                        <a href="#" role="button" data-tooltip-target="tooltip-password-{{ $id }}"
                            title="{{ __('global.password_tooltip') }}"
                            x-on:click.prevent="showPassword = !showPassword">
                            <x-tabler-eye class="w-6 h-6 text-gray-400 hover:text-gray-500 focus:text-gray-500"
                                x-show="!showPassword" />
                            <x-tabler-eye-off class="w-6 h-6 text-gray-400 hover:text-gray-500 focus:text-gray-500"
                                x-show="showPassword" />
                        </a>
                        <div id="tooltip-password-{{ $id }}" role="tooltip"
                            class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                            {{ __('global.password_tooltip') }}
                            <div class="tooltip-arrow" data-popper-arrow></div>
                        </div>
                        <x-tabler-alert-triangle class="w-6 h-6 ms-3 text-warning-500 dark:text-warning-500" wire:dirty
                            wire:target="{{ $wireModel }}" />
                        @error($wireModel)
                            <x-tabler-x class="w-6 h-6 ms-3 text-danger-500 dark:text-danger-500" x-show="error"
                                wire:dirty.remove wire:target="{{ $wireModel }}" />
                        @enderror
                        @if ($success)
                            <x-tabler-check class="w-6 h-6 ms-3 text-success-500 dark:text-success-500" x-show="success"
                                wire:dirty.remove wire:target="{{ $wireModel }}" />
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <!-- Validation Message : Dirty -->
        <p class="mt-2 text-sm text-warning-600 dark:text-warning-500" wire:dirty wire:target="{{ $wireModel }}">
            {{ __('auth.dirty_message') }}
        </p>
        @error($wireModel)
            <!-- Validation Message : Error -->
            <p id="{{ $id }}-error" class="mt-2 text-sm text-justify text-danger-600 dark:text-danger-500"
                x-show="error" wire:dirty.remove wire:target="{{ $wireModel }}">
                {{ $message }}
            </p>
        @enderror
        @if ($success)
            <!-- Validation Message : Success -->
            <p :id="id
                +
                '-success'"
                class="mt-2 text-sm text-justify text-success-600 dark:text-success-500" x-show="success"
                wire:dirty.remove wire:target="{{ $wireModel }}">
                {{ $success }}
            </p>
        @endif
        @if ($hint)
            <!-- Hint -->
            <div id="{{ $id }}-hint" class="mt-2 text-sm text-justify text-gray-500 dark:text-gray-400">
                {!! $hint !!}
            </div>
        @endif
    </div>
@else
    <div x-data="{ dirty: false, success: {{ $isSuccess ? 'true' : 'false' }}, required: {{ $required ? 'true' : 'false' }}, error: {{ $errors->has($wireModel) ? 'true' : 'false' }} }" class="mb-4">
        @if ($label)
            <!-- Label -->
            <label for="{{ $id ?? '' }}"
                class="label @if ($isSuccess) label-is-valid @endif @error($wireModel) label-is-invalid @enderror"
                wire:dirty.class="label-is-dirty" wire:target="{{ $wireModel }}"
                x-bind:class="{ 'required': required }">
                {{ $label }}
            </label>
        @endif
        <!-- Input Block -->
        <div class="relative">
            <div class="relative">
                @if ($prefix)
                    <!-- Prefix -->
                    <div class="absolute inset-y-0 flex items-center start-0 ps-3">
                        {{ $prefix }}
                    </div>
                @endif
                <!-- Main -->
                <div data-model="{{ $wireModel }}">
                    <input id="{{ $id ?? '' }}" name="{{ $name ?? '' }}" type="{{ $type ?? '' }}"
                        class="input @if ($isSuccess) is-valid @endif @error($wireModel) is-invalid @enderror @if ($disabled || $readonly) cursor-not-allowed' @endif {{ $prefix ? 'ps-10' : '' }} {{ $suffix ? 'pe-10' : '' }}"
                        {{ $attributes->whereStartsWith('wire:model') }} {{ $attributes }}
                        {{ $autofocus ? 'autofocus' : '' }} {{ $required ? 'required' : '' }}
                        wire:dirty.class="is-dirty" />
                </div>
                <!-- Suffix -->
                <div class="absolute inset-y-0 flex items-center end-0 pe-3">
                    @if ($suffix && !$errors->has($wireModel))
                        {{ $suffix }}
                    @endif
                    <x-tabler-alert-triangle class="w-6 h-6 ms-3 text-warning-500 dark:text-warning-500" wire:dirty
                        wire:target="{{ $wireModel }}" />
                    @error($wireModel)
                        <x-tabler-x class="w-6 h-6 ms-3 text-danger-500 dark:text-danger-500" x-show="error"
                            wire:dirty.remove wire:target="{{ $wireModel }}" />
                    @enderror
                    @if ($success)
                        <x-tabler-check class="w-6 h-6 ms-3 text-success-500 dark:text-success-500" x-show="success"
                            wire:dirty.remove wire:target="{{ $wireModel }}" />
                    @endif
                </div>
            </div>

        </div>
        <!-- Validation Message : Dirty -->
        <p class="mt-2 text-sm text-warning-600 dark:text-warning-500" wire:dirty wire:target="{{ $wireModel }}">
            {{ __('auth.dirty_message') }}
        </p>
        @error($wireModel)
            <!-- Validation Message : Error -->
            <p id="{{ $id }}-error" class="mt-2 text-sm text-justify text-danger-600 dark:text-danger-500"
                x-show="error" wire:dirty.remove wire:target="{{ $wireModel }}">
                {{ $message }}
            </p>
        @enderror
        @if ($success)
            <!-- Validation Message : Success -->
            <p :id="id + '-success'" class="mt-2 text-sm text-justify text-success-600 dark:text-success-500"
                x-show="success" wire:dirty.remove wire:target="{{ $wireModel }}">
                {{ $success }}
            </p>
        @endif
        @if ($hint)
            <!-- Hint -->
            <div id="{{ $id }}-hint" class="mt-2 text-sm text-justify text-gray-500 dark:text-gray-400">
                {!! $hint !!}
            </div>
        @endif
    </div>
@endif
