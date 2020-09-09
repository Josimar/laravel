<div class="col-md-12">
    <div class="card card-warning">
        <div class="card-body">
            <x-alert :message="$msgMessage ?? ''" :status="$msgStatus ?? ''"></x-alert>
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
            <!--
            <div class="row">
                <div class="col-sm-6">
                <div class="form-group">
                    <div class="form-check">
                    <input class="form-check-input" type="checkbox">
                    <label class="form-check-label">Checkbox</label>
                    </div>
                    <div class="form-check">
                    <input class="form-check-input" type="checkbox" checked>
                    <label class="form-check-label">Checkbox checked</label>
                    </div>
                    <div class="form-check">
                    <input class="form-check-input" type="checkbox" disabled>
                    <label class="form-check-label">Checkbox disabled</label>
                    </div>
                </div>
                </div>
                <div class="col-sm-6">
                <div class="form-group">
                    <div class="form-check">
                    <input class="form-check-input" type="radio" name="radio1">
                    <label class="form-check-label">Radio</label>
                    </div>
                    <div class="form-check">
                    <input class="form-check-input" type="radio" name="radio1" checked>
                    <label class="form-check-label">Radio checked</label>
                    </div>
                    <div class="form-check">
                    <input class="form-check-input" type="radio" disabled>
                    <label class="form-check-label">Radio disabled</label>
                    </div>
                </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-6">
                <div class="form-group">
                    <label>Select</label>
                    <select class="form-control">
                    <option>option 1</option>
                    <option>option 2</option>
                    <option>option 3</option>
                    <option>option 4</option>
                    <option>option 5</option>
                    </select>
                </div>
                </div>
                <div class="col-sm-6">
                <div class="form-group">
                    <label>Select Disabled</label>
                    <select class="form-control">
                    <option>option 1</option>
                    <option>option 2</option>
                    <option>option 3</option>
                    <option>option 4</option>
                    <option>option 5</option>
                    </select>
                </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-6">
                <div class="form-group">
                    <label>Select Multiple</label>
                    <select multiple class="form-control">
                    <option>option 1</option>
                    <option>option 2</option>
                    <option>option 3</option>
                    <option>option 4</option>
                    <option>option 5</option>
                    </select>
                </div>
                </div>
                <div class="col-sm-6">
                <div class="form-group">
                    <label>Select Multiple Disabled</label>
                    <select multiple class="form-control">
                    <option>option 1</option>
                    <option>option 2</option>
                    <option>option 3</option>
                    <option>option 4</option>
                    <option>option 5</option>
                    </select>
                </div>
                </div>
            </div>
            //-->
        </div>
    </div>
</div>
