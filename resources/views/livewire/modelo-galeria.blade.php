{{-- <div x-data="{ open: @entangle('isOpen') }">
    <div x-show="open" class="fixed inset-0 z-50 flex items-center justify-center bg-gray-800 bg-opacity-75"
        @click.away="open = false">
        <div class="relative bg-white rounded-lg p-6 w-11/12 h-[95%] flex flex-col items-center justify-center">
            <button @click="open = false" wire:click="closeModal"
                class="absolute top-2 right-2 text-gray-500 hover:text-gray-700">
                <i class="fas fa-times"></i>
            </button>

            @can('modelos.subir_fotos')
                <!-- Preview selected photos -->
                <div class="flex flex-initial flex-wrap overflow-y-auto max-h-24 sm:max-h-48">
                    @foreach ($newPhotos as $index => $photo)
                        <div class="relative flex items-center m-2">
                            <img src="{{ $photo->temporaryUrl() }}" alt="Preview" class="w-full h-24 object-cover">
                            <button wire:click="removeTemporaryPhoto({{ $index }})"
                                class="absolute top-1 right-1 border rounded-full px-1 bg-red-500 text-white hover:text-gray-400">
                                <x-label-sm><i class="fas fa-times"></i></x-label-sm>
                            </button>
                        </div>
                    @endforeach
                </div>

                <div class="w-full text-center">
                    <x-input type="file" wire:model="newPhotos" multiple />
                    <x-button wire:click="addPhotos" class="bg-blue-500 text-white px-4 py-2 rounded mt-2">Subir
                        fotos</x-button>
                    <x-input-error for="newPhotos.*" />
                </div>
            @endcan

            @if (Auth::user()->hasRole('admin'))
                <h2 class="text-2xl font-bold text-center mb-2">Galería de Fotos</h2>
            @endif

            <!-- Gallery of uploaded photos -->
            <div
                class="grid grid-cols-1 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-2 overflow-y-auto w-full max-h-64 {{ Auth::user()->hasRole('admin') ? 'sm:max-h-[512px]' : 'sm:max-h-[95%]' }}">
                @forelse ($fotos as $foto)
                    <div class="relative flex flex-col items-center">
                        <img src="{{ Storage::url($foto->url) }}" alt="Photo" class="object-cover">
                        @can('modelos.eliminar_fotos')
                            <button wire:click="deletePhoto({{ $foto->id }})"
                                class="absolute top-1 right-1 border rounded-full px-1 bg-red-500 text-white hover:text-gray-400">
                                <x-label-sm><i class="fas fa-times"></i></x-label-sm>
                            </button>
                        @endcan
                    </div>
                @empty
                    <div class="col-span-full text-center">
                        <p>Todavía no hay fotos subidas.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</div> --}}

<div x-data="{ open: @entangle('isOpen'), selectedPhoto: null }">
    <div x-show="open" class="fixed inset-0 z-50 flex items-center justify-center bg-gray-800 bg-opacity-75">
        <div class="relative bg-white rounded-lg p-6 w-11/12 h-[95%] flex flex-col items-center justify-center" @click.away="open = false; selectedPhoto = null">
            <button @click="open = false; selectedPhoto = null" class="absolute top-2 right-2 text-gray-500 hover:text-gray-700">
                <i class="fas fa-times"></i>
            </button>

            <!-- Modal para visualizar la imagen en tamaño grande -->
            <div x-show="selectedPhoto" class="w-full h-full flex justify-center items-start">
                <img :src="selectedPhoto" alt="Foto Grande" class="max-w-full max-h-full object-cover" @click.away="selectedPhoto = null">
                <button @click="selectedPhoto = null" class="-mx-5 my-1 text-white hover:text-gray-200">
                    <i class="fas fa-times"></i>
                </button>
                
            </div>

            @can('modelos.subir_fotos')
                <!-- Preview selected photos -->
                <div class="flex flex-initial flex-wrap overflow-y-auto max-h-24 sm:max-h-48">
                    @foreach ($newPhotos as $index => $photo)
                        <div class="relative flex items-center m-2">
                            <img src="{{ $photo->temporaryUrl() }}" alt="Preview" class="w-full h-24 object-cover">
                            <button wire:click="removeTemporaryPhoto({{ $index }})"
                                class="absolute top-1 right-1 border rounded-full px-1 bg-red-500 text-white hover:text-gray-400">
                                <x-label-sm><i class="fas fa-times"></i></x-label-sm>
                            </button>
                        </div>
                    @endforeach
                </div>

                <div x-show="!selectedPhoto" class="w-full text-center">
                    <x-input type="file" wire:model="newPhotos" multiple />
                    <x-button wire:click="addPhotos" class="bg-blue-500 text-white px-4 py-2 rounded mt-2">Subir fotos</x-button>
                    <x-input-error for="newPhotos.*" />
                </div>
            @endcan
            
            @auth
                @if (Auth::user()->hasRole('admin'))
                    <h2 x-show="!selectedPhoto" class="text-2xl font-bold text-center mb-2">Galería de Fotos</h2>
                @endif
            @endauth

            <!-- Gallery of uploaded photos -->
            <div x-show="!selectedPhoto" class="grid grid-cols-1 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-2 overflow-y-auto w-full max-h-64 @auth {{ Auth::user()->hasRole('admin') ? 'sm:max-h-[512px]' : 'sm:max-h-[95%]' }}" @endauth>
                @forelse ($fotos as $foto)
                    <div class="relative flex flex-col items-center">
                        <img src="{{ Storage::url($foto->url) }}" alt="foto" class="object-cover cursor-pointer" @click="selectedPhoto = '{{ Storage::url($foto->url) }}'; open = true">
                        @can('modelos.eliminar_fotos')
                            <button wire:click="deletePhoto({{ $foto->id }})"
                                class="absolute top-1 right-1 border rounded-full px-1 bg-red-500 text-white hover:text-gray-400">
                                <x-label-sm><i class="fas fa-times"></i></x-label-sm>
                            </button>
                        @endcan
                    </div>
                @empty
                    <div class="col-span-full text-center">
                        <p>Todavía no hay fotos subidas.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</div>



