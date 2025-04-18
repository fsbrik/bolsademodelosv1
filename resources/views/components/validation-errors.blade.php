@if ($errors->any())
    <div {!! $attributes->merge(['class' => 'p-2 border rounded-md bg-red-600']) !!}>
        <div class="font-medium text-white">{{ __('Por favor, corregí los siguientes errores') }}</div>

        <ul class="flex mt-3 text-sm text-red-600"> 
            @foreach ($errors->all() as $error)
                <li class="p-2 mx-1 inline-flex border rounded-md bg-red-100">{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
