@extends('layouts.app', [
    'showPortfolio'=>'true',  'viewPortfolio'=>'true', 'defaultPortfolio'=>'false',
    'nomePortfolio'=>__('controle.jackpot'), 'listPortfolio'=>__('controle.lista_boloes'),
    'descriptPortfolio'=>__('controle.participe_crie')
])

@section('portfolio')

    <table class="table table-striped table-centered mb-0">
        <thead>
        <tr>
            @foreach ($colunas as $key => $value)
                <th>{{$value}}</th>
            @endforeach
            <th scope="col" nowrap>{{__('controle.action')}}</th>
        </tr>
        </thead>
        <tbody>
        @foreach($registros as $key => $dado)
            <tr>
                @foreach ($colunas as $key2 => $value2)
                <td>@php echo $dado->{$key2} @endphp</td>
                @endforeach
                <td class="table-action">
                    <a href="{{route($routeNameDetail, $dado->id)}}"><i class="mdi mdi-feature-search-outline"></i></a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

@endsection
