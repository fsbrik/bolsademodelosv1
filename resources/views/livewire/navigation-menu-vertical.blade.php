<div x-data="{ open: true }" class="flex flex-col min-h-screen bg-gray-800 text-white transition-all duration-300"
    :class="{ 'w-10': !open, 'w-64': open }">
    <!-- Hamburger for mobile and desktop -->
    <div class="flex justify-end p-2">
        <button @click="open = !open"
            class="text-gray-400 hover:text-gray-500 focus:outline-none transition duration-150 ease-in-out">
            <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex" stroke-linecap="round"
                    stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round"
                    stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
    </div>

    <!-- Sidebar content -->
    <div class="flex flex-col flex-grow">
        <div class="px-4 py-2 text-2xl font-semibold bg-gray-900" :class="{ 'hidden': !open }">
            My App
        </div>
        <nav class="mt-2 flex-1 px-2 space-y-1" :class="{ 'hidden': !open }">
            @foreach ($links as $link)
                @php
                    $route = isset($link['param']) ? route($link['route'], $link['param']) : route($link['route']);
                @endphp
                <x-responsive-nav-link-vert wire:navigate :href="$route" :active="request()->routeIs($link['route'])">
                    {{ $link['name'] }}
                </x-responsive-nav-link-vert>
            @endforeach
        </nav>

    </div>
</div>
