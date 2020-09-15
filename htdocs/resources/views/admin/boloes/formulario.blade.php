<div class="form-row">
    <div class="form-group col-md-6">
        <label for="titulo" class="col-form-label">Título</label>
        <input type="text" required class="form-control" id="titulo" name="titulo" placeholder="Enter the titulo" @error('titulo') is-invalid @enderror" value="{{ old('titulo') ?? ($registro->titulo ?? '') }}">
        @error('titulo')
        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
        @enderror
    </div>
    <div class="form-group col-md-6">
        <label for="descricao" class="col-form-label">Descrição</label>
        <input type="text" class="form-control" id="descricao" name="descricao" placeholder="Enter the descricao" @error('descricao') is-invalid @enderror" value="{{ old('descricao') ?? ($registro->descricao ?? '') }}">
    </div>
</div>
<div class="form-row">
    <div class="form-group col-md-6">
        <label for="pontosextra" class="col-form-label">Extra</label>
        <input type="text" required class="form-control" id="pontosextra" name="pontosextra" placeholder="Enter the pontos extra" @error('pontosextra') is-invalid @enderror" value="{{ old('pontosextra') ?? ($registro->pontosextra ?? '') }}">
        @error('pontosextra')
        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
        @enderror
    </div>
    <div class="form-group col-md-6">
        <label for="pontostaxa" class="col-form-label">Taxa</label>
        <input type="text" required class="form-control" id="pontostaxa" name="pontostaxa" placeholder="Enter the pontos taxa" @error('pontostaxa') is-invalid @enderror" value="{{ old('pontostaxa') ?? ($registro->pontostaxa ?? '') }}">
        @error('pontostaxa')
        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
        @enderror
    </div>
</div>

<button class="btn btn-primary btn-md float-right">@lang('controle.save')</button>
