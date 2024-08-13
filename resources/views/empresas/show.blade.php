<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tu empresa') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-2xl sm:max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif

                    @if (Auth::user()->hasRole('admin'))
                        @livewire('Admin.empresa-user-show', ['empresaId' => $empresa->id])
                        <x-section-border />
                    @endif

                    @if (session()->has('message'))
                        <div x-data="{ open: true }" x-show="open"
                            class="relative p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg dark:bg-green-200 dark:text-green-800"
                            role="alert">
                            <button @click="open = false"
                                class="absolute top-2 right-2 text-gray-500 hover:text-gray-700">
                                <i class="fas fa-times"></i>
                            </button>
                            {{ session('message') }}
                        </div>
                    @endif
                    
                    @livewire('empresa-show', ['empresaId' => $empresa->id])
                    <x-section-border />



                </div>
            </div>
        </div>
    </div>
</x-app-layout>
