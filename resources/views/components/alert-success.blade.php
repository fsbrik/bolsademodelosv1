<div x-data="{ open: true }" x-show="open"
    class="relative p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg dark:bg-green-200 dark:text-green-800"
    role="alert">
    <button @click="open = false" class="absolute top-2 right-2 text-gray-500 hover:text-gray-700">
        <i class="fas fa-times"></i>
    </button>
    {{ $slot }}
</div>
