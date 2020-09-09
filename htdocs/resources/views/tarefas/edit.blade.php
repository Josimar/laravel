@extends('layouts.app')

@section('content')
    <x-pagina :page="$page" :search="$search" :caminhos="$caminhos" :routeName="$routeName" delete="" :columnList="$columnList" :recordsetList="$tarefas" :recordsetItem="$tarefa" :msgMessage="$msgMessage" :msgStatus="$msgStatus">
        <x-formulario action="{{route('tarefas.update', $tarefa->id)}}" method="put">
            <input type="hidden" value="{{ Auth::user()->id }}" name="usuarioid" id="usuarioid">
            @include('tarefas.formulario')
        </x-formulario>
    </x-pagina>
@endsection
