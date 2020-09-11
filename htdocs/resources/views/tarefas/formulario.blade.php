<div class="col-md-12">
    <div class="card card-warning">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-12">
                <div class="form-group">
                    <label for="titulo">{{__('controle.title')}}</label>
                    <input type="text" name="titulo" id="titulo" class="form-control @error('titulo') is-invalid @enderror" value="{{ old('titulo') ?? ($tarefa->titulo ?? '') }}" placeholder="título">
                    @error('titulo')
                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                <div class="form-group">
                    <label for="descricao">{{__('controle.description')}}</label>
                    <textarea name="descricao" id="descricao" class="form-control @error('descricao') is-invalid @enderror" rows="3" placeholder="descricao">{{ old('descricao') ?? ($tarefa->descricao ?? '') }}</textarea>
                    @error('descricao')
                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>
                </div>
            </div>
            <button class="btn btn-primary btn-md float-right">@lang('controle.save')</button>
        </div>
    </div>
</div>
