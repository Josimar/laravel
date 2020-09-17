@extends('layouts.app', [
    'showPortfolio'=>'true',  'viewPortfolio'=>'true', 'defaultPortfolio'=>'false',
    'nomePortfolio'=>__('controle.jackpot'), 'listPortfolio'=>__('controle.lista_boloes'),
    'descriptPortfolio'=>__('controle.participe_crie')
])

@section('portfolio')

    <x-layout :routeName="$routeName" :titulo="$titulo" :search="$search" mode="formulario" :caminhos="$caminhos" :columnList="$colunas" :recordsetList="$registros" :recordsetItem="$registro">
        <x-formulario action="{{route($routeName.'.update', $registro->id)}}" method="put">
            <div class="row">
                <div class="form-group col-6">
                    <label for="placara">{{$registro->timea}}</label>
                    <input type="text" class="form-control{{ $errors->has('placara') ? ' is-invalid' : '' }}" name="placara" value="{{ old('placara') ?? ($registro->aposta_time_a ?? '0') }}">
                    @if ($errors->has('placara'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('placara') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group col-6">
                    <label for="placarb">{{$registro->timeb}}</label>
                    <input type="text" class="form-control{{ $errors->has('placarb') ? ' is-invalid' : '' }}" name="placarb" value="{{ old('placarb') ?? ($registro->aposta_time_b  ?? '0') }}">
                    @if ($errors->has('placarb'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('placarb') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <button class="btn btn-primary btn-lg float-right">Salvar</button>
        </x-formulario>
    </x-layout>


@endsection
