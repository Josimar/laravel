@extends('layouts.app')

@section('content')
    <x-pagina :page="$page" :search="$search" :caminhos="$caminhos" :columnList="$columnList" :recordsetList="$tarefas">

    </x-pagina>
@endsection