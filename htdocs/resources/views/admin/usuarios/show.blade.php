@extends('layouts.app')

@section('content')
    <x-layout :routeName="$routeName" :titulo="$titulo" :search="$search" mode="formulario" :caminhos="$caminhos" :columnList="$colunas" :recordsetList="$usuarios" :recordsetItem="$usuario">

        <x-formulario action="{{route('usuarios.destroy', $usuario->id)}}" method="delete">
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
                            <dd>{{$usuario->name}}</dd>
                        </dl>
                        <dl>
                            <dt>{{__('controle.lastname')}}</dt>
                            <dd>{{$usuario->lastname}}</dd>
                        </dl>
                        <dl>
                            <dt>{{__('controle.email')}}</dt>
                            <dd>{{$usuario->email}}</dd>
                        </dl>
                        <dl>
                            <dt>{{__('controle.phone')}}</dt>
                            <dd>{{$usuario->phone}}</dd>
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
