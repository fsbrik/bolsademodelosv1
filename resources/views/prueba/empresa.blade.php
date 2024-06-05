<x-app-layout>
    @foreach($empresas as $empresa)
    <ul>
        <li>{{ $empresa->user->name }}</li>
        <li>{{ $empresa->user->telefono }}</li>
        <li>{{ $empresa->nom_com }}</li>
        <li>{{ $empresa->domicilio }}</li>
        <li>{{ $empresa->rubro }}</li>
    </ul>
    <br>
    
    @endforeach
</x-app-layout>