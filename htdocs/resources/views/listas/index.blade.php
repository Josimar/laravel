@extends('layouts.app')

@section('content')
    <x-layout :routeName="$routeName" :titulo="$titulo" :search="$search" mode="tabela" :caminhos="$caminhos" :columnList="$colunas" :recordsetList="$listas" :recordsetItem="$lista">

    </x-layout>
@endsection