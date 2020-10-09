@extends('layouts.admin.app')

@section('content')
    <x-layout :routeName="$routeName" :titulo="$titulo" :search="$search" mode="formulario" :caminhos="$caminhos" :columnList="$colunas" :recordsetList="$registros" :recordsetItem="$registro"  :tableNomeIdList="$tableNomeIdList" :orderlist="$orderlist">

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
                            <dt>{{__('controle.name')}}</dt>
                            <dd>{{$registro->name}}</dd>
                        </dl>
                        <dl>
                            <dt>{{__('controle.lastname')}}</dt>
                            <dd>{{$registro->lastname}}</dd>
                        </dl>
                        <dl>
                            <dt>{{__('controle.email')}}</dt>
                            <dd>{{$registro->email}}</dd>
                        </dl>
                        <dl>
                            <dt>{{__('controle.phone')}}</dt>
                            <dd>{{$registro->phone}}</dd>
                        </dl>
                    </div>
                    <div class="card-body">
                        <dl>
                            <dt>{{__('controle.paper')}}</dt>
                                @foreach ($registro->papeis as $papel)
                                    <dd>{{$papel->nome}} - {{$papel->descricao}}</dd>
                                @endforeach
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
