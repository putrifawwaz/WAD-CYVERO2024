<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'CYVERO HMSI') }}</title>
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    @vite(['resources/sass/app.scss', 'resources/css/app.css', 'resources/js/app.js'])

    <script src="https://cdn.jsdelivr.net/npm/alpinejs@2.8.2/dist/alpine.min.js" defer></script>

</head>
<body class="font-sans antialiased bg-blue-50">

    <x-app-layout>
        <nav class="bg-blue-200">
            <!-- Navbar content -->
        </nav>

        <div class="mx-40"> <!-- Tambahkan margin horizontal di sini -->
            @yield('content')
        </div>
    </x-app-layout>
</body>
</html>
