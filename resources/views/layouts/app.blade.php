<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">

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

<body class="font-sans antialiased bg-gray-100 h-full">
    <x-banner />

    <div class="min-h-screen flex flex-row">
        <!-- Sidebar -->
        @auth
            @livewire('navigation-menu-vertical')
        @endauth

        <div class="flex-grow transition-all duration-300 pt-2">
            @livewire('navigation-menu')

            <!-- Page Heading -->
            @if (isset($header))
                {{ $header }}
            @endif
            
            <!-- Page Content -->
            <main class="flex-1">
                {{ $slot }}

                <!-- Footer -->
                @if (isset($footer))
                    <footer class="bg-gray-800 text-white py-6">
                        <div class="container mx-auto px-4">
                            <div class="flex flex-col md:flex-row justify-between items-center">
                                <x-social-media></x-social-media>
                                <x-important-links></x-important-links>
                                
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
