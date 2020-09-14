<div class="form-row">
    <div class="form-group col-md-6">
        <label for="name" class="col-form-label">Nome</label>
        <input type="text" required class="form-control" id="name" name="name" placeholder="Enter the name" @error('name') is-invalid @enderror" value="{{ old('name') ?? ($registro->name ?? '') }}">
        @error('name')
        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
        @enderror
    </div>

    <div class="form-group col-md-6">
        <label for="email" class="col-form-label">E-mail</label>
        <input type="email" required class="form-control" id="email" name="email" placeholder="Enter the email" @error('email') is-invalid @enderror" value="{{ old('email') ?? ($registro->email ?? '') }}">
        @error('email')
        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
        @enderror
    </div>
</div>
<div class="form-row">
    <div class="form-group col-md-6">
        <label for="password" class="col-form-label">Password</label>
        <input type="password" class="form-control" id="password" name="password" placeholder="Enter password confirmation">
        @error('password')
        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
        @enderror
    </div>

    <div class="form-group col-md-6">
        <label for="password_confirmation" class="col-form-label">Password confirmation</label>
        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Enter password confirmation">
        @error('password_confirmation')
        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
        @enderror
    </div>
</div>
<div class="form-row">
    <div class="form-group col-md-12">
        <label for="permissoes" class="col-form-label">Papeis</label>
        <select name="permissoes[]" multiple class="custom-select custom-select-sm mb-3">
            @foreach($papeis as $key => $value)
                @php
                    $selected = '';
                    if(old('papeis') ?? false){
                        foreach (old('papeis') as $key => $id){
                            if ($value->id == $id){
                                $selected = 'selected';
                            }
                        }
                    }else{
                        if ($registro ?? false){
                            foreach ($registro->papeis as $papel){
                                if ($papel->id == $value->id){
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
