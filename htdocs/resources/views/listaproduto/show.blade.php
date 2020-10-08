@extends('layouts.admin.app')

@section('content')
    <x-layout :routeName="$routeName" :titulo="$titulo" :search="$search" mode="formulario" :caminhos="$caminhos" :columnList="$colunas" :recordsetList="$produtos" :recordsetItem="$produto" :tableNomeIdList="$tableNomeIdList" :orderlist="$orderlist">

        <x-formulario action="{{route('produtos.destroy', $produto->id)}}" method="delete">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-text-width"></i>
                            {{__('controle.name')}}
                        </h3>
                    </div>
                    <div class="card-body">
                        <dl>
                            <dt>{{__('controle.name')}}</dt>
                            <dd>{{$produto->nome}}</dd>
                        </dl>
                        <dl>
                            <dt>{{__('controle.descricao')}}</dt>
                            <dd>{{$produto->descricao}}</dd>
                        </dl>
                    </div>
                </div>
            </div>
            @if ($delete == '1')
                <button class="btn btn-danger btn-md float-right">@lang('controle.delete')</button>
            @endif
        </x-formulario>

    </x-layout>
@endsection
