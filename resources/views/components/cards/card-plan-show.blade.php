@props([
    'nombre',
    'precio',
    'unidad',
    'descripcionCorta',
    'descripcionLarga' => [],
    'selectedPlan',
    'nombreInterno', // 'plan simple', 'plan mensual', 'plan anual'
    'getHabilita',
    'estado',
    'fec_ini',
    'fec_fin'
])

<div class="flex flex-col self-center w-full sm:w-auto md:w-2/3 lg:w-1/4 {{ $selectedPlan === $nombreInterno ? 'bg-purple-300' : 'hidden' }}
     rounded-lg shadow hover:shadow-xl transition duration-100 ease-in-out p-6 mb-5">
    <div class="flex flex-col flex-grow mx-auto">
        <h3 class="text-gray-600 text-lg">{{ $nombre }}</h3>
        <p class="text-gray-600 mt-1"><span class="font-bold text-black text-4xl">{{ $precio }}</span> {{ $unidad }}</p>
        <p class="text-sm text-gray-600">{{ $descripcionCorta }}</p>
        @if (!empty($descripcionLarga))
                <div class="text-sm text-gray-600">
                    @foreach ($descripcionLarga as $linea)
                        <p class="my-2">
                            <span class="fa fa-check-circle mr-2 ml-1"></span>{{ $linea }}
                        </p>
                        @if($loop->last)
                            <span class="fa-xs">{{ $linea }}</span>
                        @endif
                    @endforeach
                </div>
        @endif
        <span class="rounded px-1 w-fit mx-auto mt-2 {{ $estado == 'Habilitado' ? 'bg-green-500' : 'bg-red-500' }}">
            Estado: {{ $estado }}
        </span>  
        <span class="rounded px-1 w-fit mx-auto mt-2 {{ $estado == 'Habilitado' ? 'bg-yellow-400' : 'hidden' }}">
            Fecha de inicio: {{ $fec_ini }}
        </span>  
        <span class="rounded px-1 w-fit mx-auto mt-2 {{ $estado == 'Habilitado' ? 'bg-yellow-600' : 'hidden' }}">
            Vencimiento: {{ $fec_fin }}
        </span>  
    </div>
</div>
