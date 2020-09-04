@extends('layouts.app')

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                <h1>{{ __('controle.list') }} {{ __($page) }}</h1>
                </div>
                <div class="col-sm-6">
                    @include('admin.breadcrumb')
                </div>
            </div>
            </div>
        </section>

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        @alert
                        @endalert

                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">{{__("Tarefas")}}</h3>
                                    <div class="card-tools">
                                    <ul class="pagination pagination-sm float-right">
                                        <!--
                                        <li class="page-item"><a class="page-link" href="#">&laquo;</a></li>
                                        <li class="page-item"><a class="page-link" href="#">1</a></li>
                                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                                        <li class="page-item"><a class="page-link" href="#">&raquo;</a></li>
                                        //-->
                                        @if(!$search && $tarefas)
                                           {{$tarefas->links()}}
                                        @endif
                                    </ul>
                                </div>
                            </div>
                            <div class="card-body p-0">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            @foreach ($columnList as $key => $value)
                                            <!--
                                            <th style="width: 10px">#</th>
                                            <th>Task</th>
                                            <th>Descrição</th>
                                            <th>Progresso</th>
                                            <th style="width: 40px">Percentual</th>
                                            //-->
                                            <th>{{$value}}</th>
                                            @endforeach
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($tarefas as $key => $tarefa)
                                    <tr>
                                        @foreach ($columnList as $key2 => $value2)
                                            @if ($key2 == 'id')
                                                <th scope="row">@php echo $tarefa->{$key2} @endphp</th>
                                            @elseif ($key2 == 'progresso')
                                                <td>
                                                    <div class="progress progress-xs">
                                                        <div class="progress-bar progress-bar-danger" style="width: @php echo $tarefa->percentcomplete @endphp%"></div>
                                                    </div>
                                                </td>
                                            @elseif ($key2 == 'percentcomplete')
                                                <td><span class="badge bg-danger">@php echo $tarefa->{$key2} @endphp%</span></td>
                                            @else
                                                <td>@php echo $tarefa->{$key2} @endphp</td>
                                            @endif
                                        @endforeach
                                    </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection