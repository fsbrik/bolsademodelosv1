<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Styles -->
    @livewireStyles
</head>

<body class="font-sans antialiased">
    <x-banner />

    <div class="min-h-screen bg-gray-100 flex-grow flex flex-row">
        <!-- Sidebar -->
        @auth
            @livewire('navigation-menu-vertical')
        @endauth

        <div class="flex-1 transition-all duration-300">
            @livewire('navigation-menu')

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main class="flex-grow">
                {{ $slot }}

                <!-- Footer -->
                @if (isset($footer))
                    <footer class="bg-gray-800 text-white py-6 mt-8">
                        <div class="container mx-auto px-4">
                            <div class="flex flex-col md:flex-row justify-between items-center">
                                <!-- Sección de Redes Sociales -->
                                <div class="flex space-x-4 mb-4 md:mb-0">
                                    <a href="https://www.tiktok.com" target="_blank"
                                        class="text-gray-400 hover:text-white">
                                        <i class="fab fa-tiktok fa-2x"></i>
                                    </a>
                                    <a href="https://www.instagram.com" target="_blank"
                                        class="text-gray-400 hover:text-white">
                                        <i class="fab fa-instagram fa-2x"></i>
                                    </a>
                                    <a href="https://www.youtube.com" target="_blank"
                                        class="text-gray-400 hover:text-white">
                                        <i class="fab fa-youtube fa-2x"></i>
                                    </a>
                                </div>

                                <!-- Sección de Enlaces -->
                                <div class="flex flex-col md:flex-row space-y-2 md:space-y-0 md:space-x-6">
                                    <a href="{{ route('terminos') }}" class="text-gray-400 hover:text-white">Términos y
                                        Condiciones</a>
                                    <a href="{{ route('politicas') }}" class="text-gray-400 hover:text-white">Política
                                        de Privacidad</a>
                                    <a href="" class="text-gray-400 hover:text-white">Preguntas Frecuentes</a>
                                </div>
                            </div>
                        </div>
                    </footer>
                @endif
            </main>


        </div>
    </div>

    @stack('modals')

    @livewireScripts
</body>

</html>
