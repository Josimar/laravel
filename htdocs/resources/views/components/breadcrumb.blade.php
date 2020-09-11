<div class="row">
    <div class="col-12">
        <div class="page-title-box" style="margin-left: 10px; margin-right: 10px;">
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    @if (isset($caminhos))
                        @foreach($caminhos as $caminho)
                            @if($caminho['url'])
                                <li class="breadcrumb-item"><a href="{{$caminho['url']}}">{{$caminho['titulo']}}</a></li>
                            @else
                                <li class="breadcrumb-item">{{$caminho['titulo']}}</li>
                            @endif
                        @endforeach
                    @endif
                </ol>
            </div>
            <h4 class="page-title">{{$titulo}}</h4>
        </div>
    </div>
</div>
