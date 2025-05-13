<div x-data="{ open: true }" x-show="open"
    class="relative p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg dark:bg-red-200 dark:text-red-800" role="alert">
    <button @click="open = false" class="absolute top-2 right-2 text-gray-500 hover:text-gray-700">
        <i class="fas fa-times"></i>
    </button>
    {{ $slot }}
</div>