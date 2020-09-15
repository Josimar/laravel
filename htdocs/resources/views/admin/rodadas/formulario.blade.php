<div class="form-row">
    <div class="form-group col-md-6">
        <label for="titulo" class="col-form-label">Título</label>
        <input type="text" required class="form-control" id="titulo" name="titulo" placeholder="Enter the titulo" @error('titulo') is-invalid @enderror" value="{{ old('titulo') ?? ($registro->titulo ?? '') }}">
        @error('titulo')
        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
        @enderror
    </div>
    <div class="form-group col-md-6">
        <label for="titulo" class="col-form-label">{{__('controle.bolao')}}</label>
        <select name="bolaoid" class="custom-select custom-select-sm mb-3">
            @foreach($boloes as $key => $value)
                @php
                    $selected = '';
                    if(old('boloes') ?? false){
                        foreach (old('boloes') as $key => $id){
                            if ($value->id == $id){
                                $selected = 'selected';
                            }
                        }
                    }else{
                        if ($registro ?? false){
                            if ($registro->bolaoid == $value->id){
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
        <label for="datainicial" class="col-form-label">Data Inicial</label>
        <input type="text" required class="form-control" id="datainicial" name="datainicial" placeholder="{{date('d-m-Y H:i:s')}}" @error('datainicial') is-invalid @enderror" value="{{ old('datainicial') ?? ($registro->datainicial ?? '') }}">
        @error('pontosextra')
        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
        @enderror
    </div>
    <div class="form-group col-md-6">
        <label for="datainicial" class="col-form-label">Data Final</label>
        <input type="text" required class="form-control" id="datafinal" name="datafinal" placeholder="{{date('d-m-Y H:i:s')}}" @error('datafinal') is-invalid @enderror" value="{{ old('datafinal') ?? ($registro->datafinal ?? '') }}">
        @error('datafinal')
        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
        @enderror
    </div>
</div>

<button class="btn btn-primary btn-md float-right">@lang('controle.save')</button>
