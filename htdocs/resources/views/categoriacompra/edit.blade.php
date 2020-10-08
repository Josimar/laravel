@extends('layouts.admin.app')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <h3>Edit Category</h3>
            <x-formulario action="{{route('categoriacompra.update', $categoria->id)}}" method="put">

                @if ($message = Session::get('success'))
                    <div class="alert alert-success alert-block">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        <strong>{{ $message }}</strong>
                    </div>
                @endif
                <div class="form-group {{ $errors->has('descricao') ? 'has-error' : '' }}">
                    <label for="descricao">{{__('controle.description')}}</label>
                    <input type="text" required name="descricao" id="descricao" class="form-control @error('descricao') is-invalid @enderror" value="{{ old('descricao') ?? ($categoria->descricao ?? '') }}" placeholder="descricao">
                    <span class="text-danger">{{ $errors->first('descricao') }}</span>
                </div>
                <div class="form-group">
                    <button class="btn btn-success">Save</button>
                </div>
            </x-formulario>
        </div>
    </div>
@endsection
