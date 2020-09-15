@extends('layouts.admin.app')

@section('content')

    <x-layout :routeName="$routeName" :titulo="$titulo" :search="$search" mode="formulario" :caminhos="$caminhos" :columnList="$colunas" :recordsetList="$registros" :recordsetItem="$registro">
        <x-formulario action="{{route($routeName.'.update', $registro->id)}}" method="put">
            @include('admin.'.$routeName.'.formulario')
        </x-formulario>
    </x-layout>

@endsection
