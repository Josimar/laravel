<div class="form-row">
    <div class="form-group col-md-6">
        <label for="name" class="col-form-label">Nome</label>
        <input type="text" required class="form-control" id="name" name="name" placeholder="Enter the name" @error('name') is-invalid @enderror" value="{{ old('name') ?? ($usuario->name ?? '') }}">
        @error('name')
        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
        @enderror
    </div>

    <div class="form-group col-md-6">
        <label for="email" class="col-form-label">E-mail</label>
        <input type="email" required class="form-control" id="email" name="email" placeholder="Enter the email" @error('email') is-invalid @enderror" value="{{ old('email') ?? ($usuario->email ?? '') }}">
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

<button class="btn btn-primary btn-md float-right">@lang('controle.save')</button>
