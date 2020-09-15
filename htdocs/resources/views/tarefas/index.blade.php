@extends('layouts.admin.app')

@section('content')
    <x-pagina :page="$page" :search="$search" :caminhos="$caminhos" :routeName="$routeName" delete="" :columnList="$columnList" :recordsetList="$tarefas" recordsetItem=""  :msgMessage="$msgMessage" :msgStatus="$msgStatus">

    </x-pagina>
@endsection
