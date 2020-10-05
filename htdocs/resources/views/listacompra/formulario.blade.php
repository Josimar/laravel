<div class="col-md-12">
    <div class="card card-warning">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-12">
                    <div class="form-group">
                        <label for="nome">{{__('controle.titulo')}}</label>
                        <input type="text" required name="titulo" id="titulo" class="form-control @error('titulo') is-invalid @enderror" value="{{ old('titulo') ?? ($lista->titulo ?? '') }}" placeholder="titulo">
                        @error('titulo')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="form-group">
                        <label for="nome">{{__('controle.descricao')}}</label>
                        <input type="text" required name="descricao" id="descricao" class="form-control @error('descricao') is-invalid @enderror" value="{{ old('descricao') ?? ($lista->descricao ?? '') }}" placeholder="descricao">
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
