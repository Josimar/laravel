<div class="col-md-12">
    <div class="card card-warning">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-12">
                <div class="form-group">
                    <label for="nome">{{__('controle.name')}}</label>
                    <input type="text" required name="nome" id="nome" class="form-control @error('nome') is-invalid @enderror" value="{{ old('nome') ?? ($lista->nome ?? '') }}" placeholder="nome">
                    @error('nome')
                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>
                </div>
            </div>
            <button class="btn btn-primary btn-md float-right">@lang('controle.save')</button>
        </div>
    </div>
</div>
