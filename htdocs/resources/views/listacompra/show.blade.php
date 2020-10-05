@extends('layouts.admin.app')

@section('content')
    <x-layout :routeName="$routeName" :titulo="$titulo" :search="$search" mode="formulario" :caminhos="$caminhos" :columnList="$colunas" :recordsetList="$listas" :recordsetItem="$lista" :tableNomeIdList="$tableNomeIdList">

        <x-formulario action="{{route('listacompra.destroy', $lista->id)}}" method="delete">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-text-width"></i>
                            {{__('controle.titulo')}}
                        </h3>
                    </div>
                    <div class="card-body">
                        <dl>
                            <dd><a href="{{route('produtos.lista', $lista->id)}}">{{$lista->titulo}}</a></dd>
                        </dl>
                    </div>
                    <div class="card-body">
                        <dl>
                            <dd><a href="{{route('produtos.lista', $lista->id)}}">{{$lista->descricao}}</a></dd>
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
