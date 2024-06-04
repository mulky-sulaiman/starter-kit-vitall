{{-- @if (Request::is(route('home')))
    @php($__inertiaSsrDispatched = true)
    @php($__inertiaSsrResponse = null)
@endif --}}

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <title inertia>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Inter:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @routes
    @vite(['resources/js/app.js', "resources/js/Pages/{$page['component']}.vue"])
    @inertiaHead
</head>

<body class="font-sans antialiased bg-gray-50 dark:bg-gray-900 dark:text-white">
    @inertia
    <noscript>
        <div
            style="position: fixed; top: 0px; left: 0px; z-index: 30000000;
                        height: 100%; width: 100%; background-color: #FFFFFF">
            <div style="display: flex; justify-content: center; align-items: center; top: 50%; height: 100%;">
                <img src="assets/images/noscript.png" />
            </div>
        </div>
    </noscript>
</body>

</html>
