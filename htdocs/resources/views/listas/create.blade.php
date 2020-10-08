@extends('layouts.admin.app')

@section('content')

    <x-layout :routeName="$routeName" :titulo="$titulo" :search="$search" mode="formulario" :caminhos="$caminhos" :columnList="$colunas" :recordsetList="$listas" :recordsetItem="$lista" :tableNomeIdList="$tableNomeIdList" :orderlist="$orderlist">
        <x-formulario action="{{route('listas.store')}}" method="post">
            <input type="hidden" value="{{ Auth::user()->id }}" name="usuarioid" id="usuarioid">
            @include('listas.formulario')
        </x-formulario>
    </x-layout>

@endsection
