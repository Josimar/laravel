@extends('layouts.admin.app')

@section('content')
    <x-layout :routeName="$routeName" :titulo="$titulo" :search="$search" mode="formulario" :caminhos="$caminhos" :columnList="$colunas" :recordsetList="$registros" :recordsetItem="$registro">

        <x-formulario action="{{route($routeName.'.destroy', $registro->id)}}" method="delete">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-text-width"></i>
                            {{__('controle.detail')}}
                        </h3>
                    </div>
                    <div class="card-body">
                        <dl>
                            <dt>{{__('controle.title')}}</dt>
                            <dd>{{$registro->titulo}}</dd>
                        </dl>
                        <dl>
                            <dt>{{__('controle.datainicial')}}</dt>
                            <dd>{{$registro->datainicial_format}}</dd>
                        </dl>
                        <dl>
                            <dt>{{__('controle.datafinal')}}</dt>
                            <dd>{{$registro->datafinal_format}}</dd>
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
