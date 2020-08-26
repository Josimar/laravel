@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Lista de Chamados') }}</div>

                @can('create', App\Model\Chamado::class)
                    <p>{{__('Criar chamado')}}</p>
                @endcan

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    @forelse($chamados as $key => $value)
                        @can('view', $value)
                            <p>{{$value->titulo}} 
                                @can('update', $value)
                                    <a href="chamado/{{$value->id}}">{{ __('editar') }}</a> 
                                @endcan
                                @can('delete', $value)
                                    <a href="chamado/{{$value->id}}">{{ __('excluir') }}</a>
                                @endcan
                            </p>
                        @endcan
                    @empty
                        <p>{{ __('Não existem chamados') }}</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
