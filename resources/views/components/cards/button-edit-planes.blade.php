@props(['route', 'param'])

<a href="{{ route($route, $param) }}"
    class="inline-flex items-center px-2 py-0 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150'"
    title="Modificar plan">
    {{ __('Modificar plan') }}
</a>
