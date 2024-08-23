{{-- <x-guest-layout>
    <div class="pt-4 bg-gray-100">
        <div class="min-h-screen flex flex-col items-center pt-6 sm:pt-0">
            <div>
                <x-authentication-card-logo />
            </div>

            <div class="w-full sm:max-w-2xl mt-6 p-6 bg-white shadow-md overflow-hidden sm:rounded-lg prose">
                {!! $policy !!}
            </div>
        </div>
    </div>
</x-guest-layout> --}}

<x-app-layout>
    <div class="w-full pt-1 sm:pt-4 bg-gray-600">
        <div class="bg-slate-200 min-h-screen flex flex-col items-center pt-2 sm:pt-6">
            <div>
                <h1 class="fa-2x text-slate-600">Política de privacidad</h1>
            </div>
            
            <div class="w-full sm:w-11/12 mt-6 p-6 bg-white shadow-md overflow-hidden sm:rounded-lg prose-sm">
                {!! nl2br(e($policy)) !!}  
            </div>
        </div>
    </div>
</x-app-layout>
