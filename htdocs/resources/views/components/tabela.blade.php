<div>
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
                <th scope="col" nowrap>{{__('controle.action')}}</th>
            </tr>
        </thead>
        <tbody>
        @foreach($recordsetList as $key => $dado)
        <tr>
            @foreach ($columnList as $key2 => $value2)
                @if ($key2 == 'id')
                    <th scope="row">@php echo $dado->{$key2} @endphp</th>
                @elseif ($key2 == 'progresso')
                    <td>
                        <div class="progress progress-xs">
                            <div class="progress-bar progress-bar-danger" style="width: @php echo $dado->percentcomplete @endphp%"></div>
                        </div>
                    </td>
                @elseif ($key2 == 'percentcomplete')
                    <td><span class="badge bg-danger">@php echo $dado->{$key2} @endphp%</span></td>
                @else
                    <td>@php echo $dado->{$key2} @endphp</td>
                @endif
            @endforeach
            <td nowrap>
                <a href="{{route(($routeName ?? 'tarefas').'.show', $dado->id)}}"><i style="color:black" class="nav-icon fas fa-info-circle" aria-hidden="true"></i></a>
                <a href="{{route(($routeName ?? 'tarefas').'.edit', $dado->id)}}"><i style="color:orange" class="nav-icon fas fa-pen" aria-hidden="true"></i></a>
                <a href="{{route(($routeName ?? 'tarefas').'.show', [$dado->id, 'delete=1'])}}"><i style="color:red" class="nav-icon fas fa-trash" aria-hidden="true"></i></a>
            </td>
        </tr>
        @endforeach
        </tbody>
    </table>
</div>
