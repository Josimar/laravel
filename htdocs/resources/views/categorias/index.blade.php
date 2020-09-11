@extends('layouts.app')

@section('content')
    <x-layout :routeName="$routeName" :titulo="$titulo" :search="$search" mode="tabela" :caminhos="$caminhos" :columnList="$colunas" :recordsetList="$categorias" :recordsetItem="$categoria">

    </x-layout>
@endsection