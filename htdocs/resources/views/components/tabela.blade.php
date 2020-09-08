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
        </tr>
        @endforeach
        </tbody>
    </table>
</div>