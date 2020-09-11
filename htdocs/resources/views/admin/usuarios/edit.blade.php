@extends('layouts.app')

@section('content')

    <x-layout :routeName="$routeName" :titulo="$titulo" :search="$search" mode="formulario" :caminhos="$caminhos" :columnList="$colunas" :recordsetList="$usuarios" :recordsetItem="$usuario">
        <x-formulario action="{{route('usuarios.update', $usuario->id)}}" method="put">
            @include('admin.usuarios.formulario')
        </x-formulario>
    </x-layout>

@endsection
