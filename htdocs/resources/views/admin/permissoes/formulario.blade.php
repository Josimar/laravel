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

<button class="btn btn-primary btn-md float-right">@lang('controle.save')</button>
