<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>CYVERO HMSI</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    <!-- Styles -->
    @vite('resources/css/app.css')

    <style>
        .header {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 50;
            background-color: #e2eaf4;
            backdrop-filter: blur(10px);
            transition: background-color 0.3s ease;
        }

        body {
            padding-top: 80px;
        }

        .hover-zoom:hover {
            transform: scale(1.1);
            transition: transform 0.3s ease;
        }

        .welcome-bg {
            background-color: rgba(113, 194, 255, 0.5);
            padding: 30px 30px;
            display: inline-block;
            border-radius: 10px;
        }

        .hero-section {
            background-color: #dcecff;
        }

        .description-text {
            max-width: 600px;
            margin: 0 auto;
            text-align: center;
        }
    </style>
</head>

<body class="antialiased">
    <div class="hero-section">
        <header class="header">
            <nav class="flex items-center justify-between p-5 lg:px-5 text-black" aria-label="Global">
                <div class="flex lg:flex-1"></div>
                <div class="hidden lg:flex lg:gap-x-12">
                    <a href="https://www.instagram.com/cyverohmsi/" class="text-sm font-semibold leading-6 text-blue-900 rounded-full p-3 text-center cursor-pointer hover:bg-blue-900 hover:text-white transform hover:scale-105 transition">Instagram</a>
                    <a href="https:/www.tiktok.com/@cyverohmsi/" class="text-sm font-semibold leading-6 text-blue-900 rounded-full p-3 text-center cursor-pointer hover:bg-blue-900 hover:text-white transform hover:scale-105 transition">TikTok</a>
                    <a href="mailto:hi.cyvero@gmail.com" class="text-sm font-semibold leading-6 text-blue-900 rounded-full p-3 text-center cursor-pointer hover:bg-blue-900 hover:text-white transform hover:scale-105 transition">Email</a>
                </div>
                <div class="hidden lg:flex lg:flex-1 lg:justify-end gap-4">
                    <a href="{{ route('register') }}" class="text-sm font-semibold leading-6 text-blue-900 rounded-full p-3 text-center cursor-pointer hover:bg-blue-900 hover:text-white transform hover:scale-105 transition">Register</a>
                    <a href="{{ route('login') }}" class="text-sm font-semibold leading-6 text-blue-900 rounded-full p-3 text-center cursor-pointer hover:bg-blue-900 hover:text-white transform hover:scale-105 transition">Log in</span></a>
                </div>
            </nav>
        </header>

        <div class="hero min-h-screen relative" style="background-image: url('{{ asset('photos/GREETINGS.png') }}'); background-size: cover; background-position: center;">
            <div class="hero-overlay bg-black bg-opacity-60 absolute inset-0"></div>

            <div class="text-center text-white absolute inset-0 flex items-center justify-center">
                <div class="max-w-screen-xl mx-auto  welcome-bg">
                    <h1 class="mb-5 text-5xl font-bold">Welcome to CYVERO 2024!</h1>
                    <p class="mb-5 description-text align-center">CYVERO (Cyan’s Event Project) adalah rangkaian kegiatan yang bertujuan untuk menjalin, menjaga, dan mempertahankan silaturahmi antar mahasiswa/i Program Studi S1 Sistem Informasi. Kegiatan ini diakhiri dengan acara simbolis perayaan Dies Natalis Program Studi S1 Sistem Informasi.</p>
                    <div class="mt-5">
                        <a href="{{ route('login') }}" class="bg-white text-blue-600 font-semibold py-2 px-4 rounded-full cursor-pointer hover:bg-blue-700 hover:text-white transform hover:scale-105 transition duration-300">Ketahui Lebih Lanjut <span aria-hidden="true">&rarr;</a>
                    </div>
                </div>
            </div>
        </div>

    </div>
</body>

</html>
