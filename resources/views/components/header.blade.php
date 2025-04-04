@props(['bold' => false])

<header class="bg-white shadow">
    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
        @if($bold)
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ $slot }} 
            </h2>
        @else
            {{ $slot }}
        @endif
    </div>
</header>