@extends('layouts.admin.app')

@section('content')
    <x-pagina :page="$page" :search="$search" :caminhos="$caminhos" :routeName="$routeName" :delete="$delete" :columnList="$columnList" :recordsetList="$tarefas" recordsetItem="$tarefa" :msgMessage="$msgMessage" :msgStatus="$msgStatus">

        <x-formulario action="{{route('tarefas.destroy', $tarefa->id)}}" method="delete">
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
                            <dd>{{$tarefa->titulo}}</dd>
                            <dt>{{__('controle.description')}}</dt>
                            <dd>{{$tarefa->descricao}}</dd>
                        </dl>
                    </div>
                </div>
            </div>
            @if ($delete == '1')
                <button class="btn btn-danger btn-md float-right">@lang('controle.delete')</button>
            @endif
        </x-formulario>

    </x-pagina>
@endsection
