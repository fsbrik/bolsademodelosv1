<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">

                @if (session()->has('message'))
                    <div x-data="{ open: true }" x-show="open"
                        class="relative p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg dark:bg-green-200 dark:text-green-800"
                        role="alert">
                        <button @click="open = false" class="absolute top-2 right-2 text-gray-500 hover:text-gray-700">
                            <i class="fas fa-times"></i>
                        </button>
                        {{ session('message') }}
                    </div>
                @endif
                
                <!-- Estado -->
                <div class="flex justify-start items-center">
                    <x-label for="estado" value="{{ __('Tu estado actual es:') }}" />
                    <x-input id="estado" type="text" :class="$estado == 1 ? 'bg-green-500 ml-1 w-12' : 'bg-red-500 ml-1 w-14'" value="{{ $this->estado_display }}"
                        disabled />
                    <x-input-error for="estado" class="mt-2" />
                </div>

                <x-button wire:click="cambiarEstado" class="mt-3">
                    Cambiar Estado
                </x-button>
            </div>
        </div>
    </div>
</div>
