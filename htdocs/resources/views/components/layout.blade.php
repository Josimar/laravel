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
                            <a href="{{route($routeName.'.create')}}" class="btn btn-success mb-2"><i class="mdi mdi-plus-circle mr-2"></i> Add {{$titulo}}</a>
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
                                <tr>
                                    <td>
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="customCheck2">
                                            <label class="custom-control-label" for="customCheck2">&nbsp;</label>
                                        </div>
                                    </td>
                                    @foreach ($columnList as $key2 => $value2)
                                        @if ($key2 == 'id')
                                            <th scope="row">@php echo $dado->{$key2} @endphp</th>
                                        @elseif ($key2 == 'progresso')
                                            <td class="table-user">
                                                <img src="{{ URL::asset('img/avatar-1.jpg') }}" alt="table-user" class="mr-2 rounded-circle">
                                                <a href="javascript:void(0);" class="text-body font-weight-semibold">{{ $usuario->name }}</a>
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
                                        @else
                                            <td>@php echo $dado->{$key2} @endphp</td>
                                        @endif
                                    @endforeach
                                    <td class="action-icon" nowrap>
                                        <a href="{{route(($routeName ?? 'tarefas').'.show', $dado->id)}}"><i class="mdi mdi-feature-search-outline"></i></a>
                                        <a href="{{route(($routeName ?? 'tarefas').'.edit', $dado->id)}}"><i class="mdi mdi-square-edit-outline"></i></a>
                                        <a href="{{route(($routeName ?? 'tarefas').'.show', [$dado->id, 'delete=1'])}}"><i class="mdi mdi-delete"></i></a>
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
