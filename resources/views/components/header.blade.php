@props(['bold' => false])

<header class="bg-white shadow">
    <div class="max-w-7xl mx-auto pt-2 pb-1 px-4 sm:px-6 lg:px-8">
        @if($bold)
            <h4>
                {{ $slot }} 
            </h4>
        @else
            <p>
                {{ $slot }}
            </p>            
        @endif
    </div>
</header>
