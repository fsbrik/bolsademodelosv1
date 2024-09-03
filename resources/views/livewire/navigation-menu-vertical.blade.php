{{-- <div x-data="{ open: true }" class="flex flex-col min-h-screen bg-gray-800 text-white transition-all duration-300"
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
        
        <nav class="mt-2 flex-1 px-2 space-y-1" :class="{ 'hidden': !open }">
            @foreach ($links as $link)
                {{-- Determinar si la ruta usa parametros 
                @php
                    $route = isset($link['param']) ? route($link['route'], $link['param']) : route($link['route']);
                @endphp

                {{-- Establecer la clase active 
                <x-responsive-nav-link-vert wire:navigate :href="$route" :active="request()->routeIs($link['route'])">
                    {{ $link['name'] }}
                </x-responsive-nav-link-vert>
            @endforeach
        </nav>

    </div>
</div> --}}

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
            Menú
        </div>
        <nav class="mt-2 flex-1 px-2 space-y-1" :class="{ 'hidden': !open }">
            @foreach ($links as $link)
                
            {{-- Determinar si la ruta tiene o no parametros
            Definir el estado "active" si esta activo o no --}}
                @php
                    $route = isset($link['param']) ? route($link['route'], $link['param']) : route($link['route']);
                    $isActive =
                        ($link['route'] === 'modelos.show' ||
                            $link['route'] === 'modelos.index' ||
                            $link['route'] === 'modelos.edit') &&
                        !request()->routeIs('modelos.cambiar_estado')
                            ? $isModeloRouteActive
                            : (($link['route'] === 'empresas.index' ||
                            $link['route'] === 'empresas.create' ||
                            $link['route'] === 'empresas.edit') && (
                            !request()->routeIs('empresas.planes') && !request()->routeIs('empresas.contrataciones.index'))
                                ? $isEmpresaRouteActive
                                : request()->routeIs($link['route']));                               
                @endphp
                <x-responsive-nav-link-vert wire:navigate :href="$route" :active="$isActive">
                    {{ $link['name'] }}
                </x-responsive-nav-link-vert>
            @endforeach
        </nav>
    </div>
</div>
