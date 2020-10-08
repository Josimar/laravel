@extends('layouts.admin.app')

@section('content')

    <x-layout :routeName="$routeName" :titulo="$titulo" :search="$search" mode="formulario" :caminhos="$caminhos" :columnList="$colunas" :recordsetList="$produtos" :recordsetItem="$produto" :tableNomeIdList="$tableNomeIdList" :orderlist="$orderlist">
        <x-formulario action="{{route('produtocompra.update', $produto->id)}}" method="put">
            @include('listaproduto.formulario')
        </x-formulario>
    </x-layout>

@endsection
