@extends('layouts.admin.app')

@section('content')

    <x-layout :routeName="$routeName" :titulo="$titulo" :search="$search" mode="formulario" :caminhos="$caminhos" :columnList="$colunas" :recordsetList="$registros" :recordsetItem="$registro" :tableNomeIdList="$tableNomeIdList" :orderlist="$orderlist">
        <x-formulario action="{{route($routeName.'.store')}}" method="post">
            @include('listaproduto.formulario')
        </x-formulario>
    </x-layout>

@endsection
