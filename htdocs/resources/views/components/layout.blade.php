<div class="container-fluid">
    <x-breadcrumb :titulo="$titulo" :caminhos="$caminhos"></x-breadcrumb>

    <x-alert></x-alert>

    {{$slot}}

    @if ($mode == 'formulario')
    @endif

    @if ($mode == 'tabela')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row mb-2">
                        <div class="col-sm-4">
                            @if (empty($tableNomeIdList))
                                <a href="{{route($routeName.'.create')}}" class="btn btn-success mb-2"><i class="mdi mdi-plus-circle mr-2"></i> Add {{$titulo}}</a>
                            @else
                                @php
                                $key = array_search('lista', array_column($tableNomeIdList, 'tabela'));
                                @endphp
                                @if ($key)
                                    <a href="{{route($routeName.'.create'.'.'.$tableNomeIdList[$key]['tabela'], $tableNomeIdList[$key]['id'])}}" class="btn btn-success mb-2"><i class="mdi mdi-plus-circle mr-2"></i> Add {{$titulo}}</a>
                                @endif
                            @endif
                        </div>
                        <div class="col-sm-8">
                            <div class="text-sm-right">
                                <button type="button" class="btn btn-light mb-2 mr-1"><i class="mdi mdi-settings"></i></button>
                                <button type="button" class="btn btn-light mb-2 mr-1">Import</button>
                                <button type="button" class="btn btn-light mb-2">Export</button>
                            </div>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-centered table-borderless table-hover w-100 dt-responsive nowrap" id="{{$routeName}}-datatable">
                            <thead class="thead-light">
                                <tr>
                                    <th style="width: 20px;">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="customCheck1">
                                            <label class="custom-control-label" for="customCheck1">&nbsp;</label>
                                        </div>
                                    </th>
                                    @foreach ($columnList as $key => $value)
                                        <th>{{$value}}</th>
                                    @endforeach
                                    <th style="width: 75px;" scope="col" nowrap>{{__('controle.action')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($recordsetList as $key => $dado)
                                <tr class="ui-state-default">
                                    <td>
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="customCheck2">
                                            <label class="custom-control-label" for="customCheck2">&nbsp;</label>
                                        </div>
                                    </td>
                                    @php
                                    $count = 1;
                                    @endphp
                                    @foreach ($columnList as $key2 => $value2)
                                        @if ($key2 == 'id')
                                            <td scope="row">@php echo $dado->{$key2} @endphp</td>
                                        @elseif ($key2 == 'OrderAsc')
                                            <td scope="row">@php echo $count++ @endphp</td>
                                        @elseif ($key2 == 'progresso')
                                            <td class="table-user">
                                                <img src="{{ URL::asset('img/avatar-1.jpg') }}" alt="table-user" class="mr-2 rounded-circle">
                                                <a href="javascript:void(0);" class="text-body font-weight-semibold"> (colocar nome do User)</a>
                                            </td>
                                        @elseif ($key2 == 'progresso')
                                            <td>
                                                <div class="progress progress-xs">
                                                    <div class="progress-bar progress-bar-danger" style="width: @php echo $dado->percentcomplete @endphp%"></div>
                                                </div>
                                            </td>
                                        @elseif ($key2 == 'percentcomplete')
                                            <td><span class="badge bg-danger">@php echo $dado->{$key2} @endphp%</span></td>
                                        @elseif ($key2 == 'publico')
                                            <td><span>@php echo $dado->{$key2} == "1" ? "true" : "false"  @endphp</span></td>
                                        @elseif (strpos($key2, '->') > 0)
                                            <td>
                                                @php
                                                    if ($key2 == 'categoria->descricao'){
                                                        echo $dado->categoria['descricao'];
                                                    }
                                                @endphp
                                            </td>
                                        @else
                                            <td>@php echo $dado->{$key2} @endphp</td>
                                        @endif
                                    @endforeach
                                    <td class="action-icon" nowrap>
                                        <a href="{{route(($routeName ?? 'tarefas').'.show', $dado->id)}}"><i class="mdi mdi-feature-search-outline"></i></a>
                                        <a href="{{route(($routeName ?? 'tarefas').'.edit', $dado->id)}}"><i class="mdi mdi-square-edit-outline"></i></a>
                                        <a href="{{route(($routeName ?? 'tarefas').'.show', [$dado->id, 'delete=1'])}}"><i class="mdi mdi-delete"></i></a>
                                        @if (! empty($orderlist))
                                        <a href="{{route(($routeName ?? 'tarefas').'.order', [$dado->listaid, $dado->id, 'up'])}}"><i class="mdi mdi-sort-alphabetical-descending"></i></a>
                                        <a href="{{route(($routeName ?? 'tarefas').'.order', [$dado->listaid, $dado->id, 'down'])}}"><i class="mdi mdi-sort-alphabetical-ascending"></i></a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>
