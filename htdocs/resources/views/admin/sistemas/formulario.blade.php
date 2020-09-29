<div class="form-row">
    <div class="form-group col-md-12">
        <label for="titulo" class="col-form-label">Título</label>
        <input type="text" required class="form-control" id="titulo" name="titulo" placeholder="Enter the titulo" @error('titulo') is-invalid @enderror" value="{{ old('titulo') ?? ($registro->titulo ?? '') }}">
        @error('titulo')
        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
        @enderror
    </div>
</div>
<div class="form-row">
    <div class="form-group col-md-12">
        <label for="descricao" class="col-form-label">Descrição</label>
        <input type="text" class="form-control" id="descricao" name="descricao" placeholder="Enter the descrição" @error('descricao') is-invalid @enderror" value="{{ old('descricao') ?? ($registro->descricao ?? '') }}">
        @error('descricao')
        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
        @enderror
    </div>
</div>
<div class="form-row">
    <div class="form-group col-md-12">
        <label for="categorias" class="col-form-label">Categorias</label>
        <select name="categorias[]" multiple class="custom-select custom-select-sm mb-3">
            @foreach($categorias as $key => $value)
                @php
                    $selected = '';
                    if(old('categorias') ?? false){
                        foreach (old('categorias') as $key => $id){
                            if ($value->id == $id){
                                $selected = 'selected';
                            }
                        }
                    }else{
                        if ($registro ?? false){
                            foreach ($registro->categorias as $categoria){
                                if ($categoria->id == $value->id){
                                    $selected = "selected";
                                }
                            }
                        }
                    }
                @endphp
                <option {{$selected}} value="{{$value->id}}">{{$value->id}} - {{$value->categoriaid}} - {{$value->descricao}}</option>
            @endforeach
        </select>
    </div>
</div>

<button class="btn btn-primary btn-md float-right">@lang('controle.save')</button>
