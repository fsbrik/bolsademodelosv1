
<div class="ml-2 grid grid-cols-1 md:grid-cols-4 lg:grid-cols-5 gap-2">
    @foreach ($modelos as $modelo)
        <div class="flex flex-col">
            <div class="bg-white shadow-md rounded-lg overflow-hidden">
                <div class="p-2 flex justify-between">
                    <img src="{{ $modelo->user->profile_photo_url }}" alt="{{ $modelo->user->name }}"
                        class="h-48 w-28 rounded-md object-cover">
                    <div class="flex flex-col ml-1">
                        <p class="font-semibold">## {{ $modelo->mod_id }}</p>                        
                        <x-label-sm class="border-t break-all">{{$modelo->user->name }}</x-label-sm>
                        <x-label-sm>{{$modelo->user->telefono }}</x-label-sm>
                        <x-label-sm class="border-b break-all">{{$modelo->user->email }}</x-label-sm>
                        <x-label-sm>{{ __('Edad: ') . \Carbon\Carbon::parse($modelo->fec_nac)->age . __(' años') }}</x-label-sm>
                        <x-label-sm>{{ __('Estatura: ') . $modelo->estatura . __(' mts.') }}</x-label-sm>
                        <x-label-sm>{{ __('Calzado: ') . $modelo->calzado }}</x-label-sm>
                        <x-label-sm>{{ __('Medidas: ') . $modelo->medidas }}</x-label-sm>
                        <x-label-sm>{{ __('Viajar al exterior: ') . ($modelo->dis_via ? 'si' : 'no') }}</x-label-sm>
                        <x-label-sm class="border-b">{{ __('Título de modelo: ') . ($modelo->tit_mod ? 'si' : 'no') }}</x-label-sm>
                        <x-label-sm><i class="fas fa-money-bill-wave"></i><i class="fas fa-money-bill-wave px-1"></i><i
                                class="fas fa-money-bill-wave"></i></x-label-sm>
                        <x-label-sm>{{ __('1/2 jornada: u$s') . $modelo->tar_med }}</x-label-sm>
                        <x-label-sm>{{ __('Jorn. comp.: u$s') . $modelo->tar_com }}</x-label-sm>

                    </div>
                </div>
                <div class="px-2 flex border-t flex-auto items-center">
                    <i
                        class="fas fa-map-marker-alt pr-1"></i><x-label-sm>{{ __('Residencia: ') . $modelo->zon_res }}</x-label-sm>
                </div>
                <div class="p-2 flex justify-between">
                    <div class="">
                        <x-label-sm><i class="fas fa-book"></i>
                            {{ __('Nivel de inglés: ') . $modelo->ingles }}</x-label-sm>
                        <x-label-sm><i class="fas fa-briefcase"></i>
                            {{ __('Disponibilidad: ') . $modelo->dis_tra }}</x-label-sm>
                    </div>

                    <div class="px-2 -mt-5 flex justify-between shadow-md rounded-lg overflow-hidden items-center">
                        @can('modelos.show')
                            <a href="{{ route('modelos.show', $modelo->id) }}"
                                class="text-indigo-600 hover:text-indigo-900 pr-2" title="Ver">
                                <i class="fas fa-eye"></i>
                            </a>
                        @endcan
                        <i class="fas fa-image"></i>
                        <i class="fas fa-add"></i>
                    </div>

                </div>
            </div>
        </div>
    @endforeach
    <div class="mt-4">

        {{--  {{ $modelos->links() }} --}}

    </div>
</div>
