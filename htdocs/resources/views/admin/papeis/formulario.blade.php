<div class="form-row">
    <div class="form-group col-md-12">
        <label for="nome" class="col-form-label">Nome</label>
        <input type="text" required class="form-control" id="nome" name="nome" placeholder="Enter the nome" @error('nome') is-invalid @enderror" value="{{ old('nome') ?? ($registro->nome ?? '') }}">
        @error('nome')
        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
        @enderror
    </div>
</div>
<div class="form-row">
    <div class="form-group col-md-12">
        <label for="descricao" class="col-form-label">Descrição</label>
        <input type="text" required class="form-control" id="descricao" name="descricao" placeholder="Enter the descricao" @error('descricao') is-invalid @enderror" value="{{ old('descricao') ?? ($registro->descricao ?? '') }}">
        @error('descricao')
        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
        @enderror
    </div>
</div>
<div class="form-row">
    <div class="form-group col-md-12">
        <label for="permissoes" class="col-form-label">Permissão</label>
        <select name="permissoes[]" multiple class="custom-select custom-select-sm mb-3">
            @foreach($permissoes as $key => $value)
                @php
                    $selected = '';
                    if(old('permissoes') ?? false){
                        foreach (old('permissoes') as $key => $id){
                            if ($value->id == $id){
                                $selected = 'selected';
                            }
                        }
                    }else{
                        if ($registro ?? false){
                            foreach ($registro->permissoes as $permissao){
                                if ($permissao->id == $value->id){
                                    $selected = "selected";
                                }
                            }
                        }
                    }
                @endphp
                <option {{$selected}} value="{{$value->id}}">{{$value->nome}}</option>
            @endforeach
        </select>
    </div>
</div>


<button class="btn btn-primary btn-md float-right">@lang('controle.save')</button>
