@extends('layouts.admin.app')

@section('content')

    <x-layout :routeName="$routeName" :titulo="$titulo" :search="$search" mode="formulario" :caminhos="$caminhos" :columnList="$colunas" :recordsetList="$produtos" :recordsetItem="$produto">
        <x-formulario action="{{route('produtos.update', $produto->id)}}" method="put">
            <input type="hidden" value="{{ Auth::user()->id }}" name="usuarioid" id="usuarioid">
            @include('produtos.formulario')
        </x-formulario>
    </x-layout>

@endsection
