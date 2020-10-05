@extends('layouts.admin.app')

@section('content')
    <x-layout :routeName="$routeName" :titulo="$titulo" :search="$search" mode="tabela" :caminhos="$caminhos" :columnList="$colunas" :recordsetList="$usuarios" :recordsetItem="$usuario" :tableNomeIdList="$tableNomeIdList">

    </x-layout>
@endsection
