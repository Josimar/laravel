@extends('layouts.app')

@section('content')
    <x-pagina :page="$page" :search="$search" :caminhos="$caminhos" :columnList="$columnList" :recordsetList="$tarefas">
        <x-formulario action="{{route('tarefas.store')}}" method="post">
            <input type="hidden" value="{{ Auth::user()->id }}" name="usuarioid" id="usuarioid">
            @include('tarefas.formulario')
        </x-formulario>
    </x-pagina>
@endsection
