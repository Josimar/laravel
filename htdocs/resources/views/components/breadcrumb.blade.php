<div>
    <ol class="breadcrumb float-sm-right {{config('app.corSite')}}">
        @if (isset($caminhos))
            @foreach($caminhos as $caminho)
                @if($caminho['url'])
                    <li class="breadcrumb-item">
                        <a href="{{$caminho['url']}}" class="breadcrumb">{{$caminho['titulo']}}</a>
                    </li>
                @else
                    <li class="breadcrumb-item">{{$caminho['titulo']}}</li>
                @endif
            @endforeach
        @else
            <li class="breadcrumb">{{__('Admin')}}</li>
        @endif
    </ol>
</div>