<?php
use Illuminate\Support\Str;
?>

@props(['title' => '', 'head' => ''])

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="content-language" content="{{ str_replace('_', '-', app()->getLocale()) }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="author" content="{{ config('app.name', 'VITALL') }}">
    @if ($head)
        {!! $head !!}
    @else
        <meta name="description" content="{{ $title }}" />
        <meta name="keywords" content="{{ Str::lower(str_replace(' ', ',', $title)) }}" />
    @endif

    <x-statics.header-script />
    @vite(['resources/css/main.css', 'resources/js/main.js'])
    @stack('styles')

    <title>{{ $title ? $title . ' - ' . config('app.name', 'VITALL') : config('app.name', 'VITALL') }}</title>
</head>

<body x-data="$store.confirmDialog" class="font-sans antialiased text-gray-900 bg-gray-50 dark:bg-gray-900 dark:text-white">
    <div
        class="fixed flex items-center justify-center top-0 left-0 z-50 bg-pink-100 text-pink-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-pink-900 dark:text-pink-300 uppercase">
        <x-tabler-brand-livewire class="w-4 h-4 mr-2" />
        <span>Livewire Mode</span>
    </div>
    {{ $slot }}
    <x-statics.bottom-script />
    @persist('noscript')
    <noscript>
        <div
            style="position: fixed; top: 0px; left: 0px; z-index: 30000000;
                        height: 100%; width: 100%; background-color: #FFFFFF">
            <div style="display: flex; justify-content: center; align-items: center; top: 50%; height: 100%;">
                <img src="assets/images/noscript.png" />
            </div>
        </div>
    </noscript>
    @endpersist('noscript')
    @stack('scripts')
</body>

</html>
