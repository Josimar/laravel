<div class="form-row">
    <div class="form-group col-md-4">
        <label for="titulo" class="col-form-label">Título</label>
        <input type="text" required class="form-control" id="titulo" name="titulo" placeholder="Enter the titulo" @error('titulo') is-invalid @enderror" value="{{ old('titulo') ?? ($registro->titulo ?? '') }}">
        @error('titulo')
        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
        @enderror
    </div>
    <div class="form-group col-md-4">
        <label for="estadio" class="col-form-label">Estádio</label>
        <input type="text" class="form-control" id="estadio" name="estadio" placeholder="Enter the estadio" @error('estadio') is-invalid @enderror" value="{{ old('estadio') ?? ($registro->estadio ?? '') }}">
    </div>
    <div class="form-group col-md-4">
        <label for="rodadaid" class="col-form-label">{{__('controle.rounds')}}</label>
        <select name="rodadaid" class="custom-select custom-select-sm mb-3">
            @foreach($rodadas as $key => $value)
                @php
                    $selected = '';
                    if(old('rodadas') ?? false){
                        foreach (old('rodadas') as $key => $id){
                            if ($value->id == $id){
                                $selected = 'selected';
                            }
                        }
                    }else{
                        if ($registro ?? false){
                            if ($registro->rodadaid == $value->id){
                                $selected = "selected";
                            }
                        }
                    }
                @endphp
                <option {{$selected}} value="{{$value->id}}">{{$value->titulo}}</option>
            @endforeach
        </select>
    </div>
</div>
<div class="form-row">
    <div class="form-group col-md-6">
        <label for="timea" class="col-form-label">Time A</label>
        <input type="text" required class="form-control" id="timea" name="timea" placeholder="Enter the team a" @error('timea') is-invalid @enderror" value="{{ old('timea') ?? ($registro->timea ?? '') }}">
        @error('timea')
        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
        @enderror
    </div>
    <div class="form-group col-md-6">
        <label for="timeb" class="col-form-label">Time B</label>
        <input type="text" required class="form-control" id="timeb" name="timeb" placeholder="Enter the team b" @error('timeb') is-invalid @enderror" value="{{ old('timeb') ?? ($registro->timeb ?? '') }}">
        @error('timeb')
        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
        @enderror
    </div>
</div>
<div class="form-row">
    <div class="form-group col-md-3">
        <label for="resultado" class="col-form-label">Resultado (A=TimeA, B=TimeB, E=Empate)</label>
        <select name="resultado" class="custom-select custom-select-sm mb-3">
            @php
                $lista =  ['A', 'B', 'E'];
            @endphp
            @foreach($lista as $key => $value)
                @php
                    $selected = '';
                    if(old('resultado') ?? false){
                        if (old('resultado') == $value){
                          $selected = 'selected';
                        }
                    }else{
                        if ($registro ?? false){
                            if ($registro->resultado == $value){
                                $selected = "selected";
                            }
                        }else{
                            if ($value == 'E'){
                                $selected = "selected";
                            }
                        }
                    }
                @endphp
                <option {{$selected}} value="{{$value}}">{{$value}}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group col-md-3">
        <label for="placara" class="col-form-label">Placa A</label>
        <input type="text" required class="form-control" id="placara" name="placara" placeholder="Enter the placar a" @error('placara') is-invalid @enderror" value="{{ old('placara') ?? ($registro->placara ?? '0') }}">
        @error('placara')
        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
        @enderror
    </div>
    <div class="form-group col-md-3">
        <label for="placarb" class="col-form-label">Placar B</label>
        <input type="text" required class="form-control" id="placarb" name="placarb" placeholder="Enter the placar b" @error('placarb') is-invalid @enderror" value="{{ old('placarb') ?? ($registro->placarb ?? '0') }}">
        @error('placarb')
        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
        @enderror
    </div>
    <div class="form-group col-md-3">
        <label for="data" class="col-form-label">Data</label>
        <input type="text" required class="form-control" id="data" name="data" placeholder="Enter the date" @error('data') is-invalid @enderror" value="{{ old('data') ?? ($registro->data ?? '') }}">
        @error('data')
        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
        @enderror
    </div>
</div>

<button class="btn btn-primary btn-md float-right">@lang('controle.save')</button>
