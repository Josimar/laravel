@extends('layouts.admin.app')

@section('content')
    <x-layout :routeName="$routeName" :titulo="$titulo" :search="$search" mode="tabela" :caminhos="$caminhos" :columnList="$colunas" :recordsetList="$produtos" :recordsetItem="$produto" :tableNomeIdList="$tableNomeIdList" :orderlist="$orderlist">

    </x-layout>
@endsection
