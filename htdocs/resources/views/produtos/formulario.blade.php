<div class="col-md-12">
    <div class="card card-warning">
        <div class="card-body">
            <div class="row">
                <div class="form-group col-md-6">
                    <label for="listaid" class="col-form-label">{{__('controle.list')}}</label>
                    <select id="listaid" name="listaid" class="form-control">
                        <option value="">Choose</option>
                        <option value="1">Opção 1</option>
                    </select>
                </div>
                <div class="form-group col-md-6">
                    <label for="categoriaid" class="col-form-label">{{__('controle.category')}}</label>
                    <select id="categoriaid" name="categoriaid" class="form-control">
                        <option value="">Choose</option>
                        <option value="1">Opção 1</option>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                <div class="form-group">
                    <label for="nome">{{__('controle.name')}}</label>
                    <input type="text" required name="nome" id="nome" class="form-control @error('nome') is-invalid @enderror" value="{{ old('nome') ?? ($produto->nome ?? '') }}" placeholder="{{__('controle.enter_value')}}">
                    @error('nome')
                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-sm-3">
                    <label for="quantidade">{{__('controle.quantity')}}</label>
                    <input type="text" name="quantidade" id="quantidade" class="form-control @error('quantidade') is-invalid @enderror" value="{{ old('quantidade') ?? ($produto->quantidade ?? '') }}" placeholder="0">
                    @error('quantidade')
                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>
                <div class="form-group col-sm-3">
                    <label for="valor">{{__('controle.value')}}</label>
                    <input type="text" name="valor" id="valor" class="form-control @error('valor') is-invalid @enderror" value="{{ old('valor') ?? ($produto->valor ?? '') }}" placeholder="0">
                    @error('valor')
                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>
                <div class="form-group col-sm-3">
                    <label for="unidade">{{__('controle.unit')}}</label>
                    <input type="text" name="unidade" id="unidade" class="form-control @error('unidade') is-invalid @enderror" value="{{ old('unidade') ?? ($produto->unidade ?? '') }}" placeholder="un">
                    @error('unidade')
                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>
                <div class="form-group col-sm-3">
                    <label for="precisao">{{__('controle.precision')}}</label>
                    <input type="text" name="precisao" id="precisao" class="form-control @error('precisao') is-invalid @enderror" value="{{ old('precisao') ?? ($produto->precisao ?? '') }}" placeholder="0">
                    @error('precisao')
                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>
            </div>
            <div class="row">
                <div class="form-group col-sm-12">
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="purchased">
                        <label class="custom-control-label" for="purchased" name="purchased" id="purchased">{{__('controle.purchased')}}</label>
                    </div>
                </div>
            </div>
            <button class="btn btn-primary btn-md float-right">@lang('controle.save')</button>
        </div>
    </div>
</div>
