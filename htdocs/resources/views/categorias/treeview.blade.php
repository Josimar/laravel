@extends('layouts.admin.app')

@section('content')
    <div class="row">
        <div class="col-md-4">
            <h3>Category List</h3>
            <ul id="treeCategoria">
                @foreach($categorias as $category)
                    <li>
                        {{ $category->descricao }}
                        @if(count($category->childs))
                            @include('categorias.treeviewitem',['childs' => $category->childs])
                        @endif
                    </li>
                @endforeach
            </ul>
        </div>
        <div class="col-md-8">
            <h3>New Category</h3>
            <x-formulario action="{{route('categorias.store')}}" method="post">

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
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group {{ $errors->has('categoriaid') ? 'has-error' : '' }}">
                            <label for="categoria">{{__('controle.category')}}</label>
                            <select name="categoriaid1" id="categoriaid1" size="10" class="custom-select custom-select-sm mb-3 categoriaid1" style="{{route('api.categorias.child', 1)}}#categoriaid2">
                                @foreach($categorias as $key => $value)
                                    @php
                                        $selected = '';
                                        if(old('categorias') ?? false){
                                            foreach (old('categorias') as $key => $id){
                                                if ($value->id == $id){
                                                    $selected = 'selected';
                                                }
                                            }
                                        }else{
                                            if ($categoria ?? false){
                                                foreach ($categoria->categorias as $allCategories){
                                                    if ($categorias->id == $value->id){
                                                        $selected = "selected";
                                                    }
                                                }
                                            }
                                        }
                                    @endphp
                                    <option {{$selected}} value="{{$value->id}}">{{$value->descricao}}</option>
                                @endforeach
                            </select>
                            <span class="text-danger">{{ $errors->first('categoriaid') }}</span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group {{ $errors->has('categoriaid') ? 'has-error' : '' }}">
                            <label for="categoria">{{__('controle.category')}}</label>
                            <select name="categoriaid2" id="categoriaid2" size="10" class="custom-select custom-select-sm mb-3 categoriaid2" style="{{route('api.categorias.child', 2)}}#categoriaid3">
                            </select>
                            <span class="text-danger">{{ $errors->first('categoriaid') }}</span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group {{ $errors->has('categoriaid') ? 'has-error' : '' }}">
                            <label for="categoria">{{__('controle.category')}}</label>
                            <select name="categoriaid3" id="categoriaid3"  size="10" class="custom-select custom-select-sm mb-3 categoriaid3" style="{{route('api.categorias.child', 3)}}#categoriaid4">
                            </select>
                            <span class="text-danger">{{ $errors->first('categoriaid') }}</span>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <button class="btn btn-success">Add New</button>
                </div>

            </x-formulario>

            <br />

            <h3>Edit Category</h3>
            <x-formulario action="{{route('categorias.atualizar', 0)}}" method="post">

                @if ($message = Session::get('success'))
                    <div class="alert alert-success alert-block">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        <strong>{{ $message }}</strong>
                    </div>
                @endif
                <div class="form-group {{ $errors->has('descricao') ? 'has-error' : '' }}">
                    <label for="descricao">{{__('controle.description')}}</label>
                    <input type="text" required name="descricao" id="descricao" class="editdescricao form-control @error('descricao') is-invalid @enderror" value="{{ old('descricao') ?? ($categoria->descricao ?? '') }}" placeholder="descricao">
                    <input type="hidden" name="id" id="id" class="editid">
                    <span class="text-danger">{{ $errors->first('descricao') }}</span>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group {{ $errors->has('categoriaid') ? 'has-error' : '' }}">
                            <label for="categoria">{{__('controle.category')}}</label>
                            <select name="categoriaid4" id="categoriaid4" size="10" class="custom-select custom-select-sm mb-3 categoriaid4" style="{{route('api.categorias.child', 1)}}#categoriaid5">
                                @foreach($categorias as $key => $value)
                                    @php
                                        $selected = '';
                                        if(old('categorias') ?? false){
                                            foreach (old('categorias') as $key => $id){
                                                if ($value->id == $id){
                                                    $selected = 'selected';
                                                }
                                            }
                                        }else{
                                            if ($categoria ?? false){
                                                foreach ($categoria->categorias as $allCategories){
                                                    if ($categorias->id == $value->id){
                                                        $selected = "selected";
                                                    }
                                                }
                                            }
                                        }
                                    @endphp
                                    <option {{$selected}} value="{{$value->id}}">{{$value->descricao}}</option>
                                @endforeach
                            </select>
                            <span class="text-danger">{{ $errors->first('categoriaid') }}</span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group {{ $errors->has('categoriaid') ? 'has-error' : '' }}">
                            <label for="categoria">{{__('controle.category')}}</label>
                            <select name="categoriaid5" id="categoriaid5" size="10" class="custom-select custom-select-sm mb-3 categoriaid5" style="{{route('api.categorias.child', 2)}}#categoriaid6">
                            </select>
                            <span class="text-danger">{{ $errors->first('categoriaid') }}</span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group {{ $errors->has('categoriaid') ? 'has-error' : '' }}">
                            <label for="categoria">{{__('controle.category')}}</label>
                            <select name="categoriaid6" id="categoriaid6"  size="10" class="custom-select custom-select-sm mb-3 categoriaid6" style="{{route('api.categorias.child', 3)}}#categoriaid7">
                            </select>
                            <span class="text-danger">{{ $errors->first('categoriaid') }}</span>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <button class="btn btn-success">Edit</button>
                </div>

            </x-formulario>
        </div>
    </div>

<style>
    .tree, .tree ul {
        margin:0;
        padding:0;
        list-style:none
    }
    .tree ul {
        margin-left:1em;
        position:relative
    }
    .tree ul ul {
        margin-left:.5em
    }
    .tree ul:before {
        content:"";
        display:block;
        width:0;
        position:absolute;
        top:0;
        bottom:0;
        left:0;
        border-left:1px solid
    }
    .tree li {
        margin:0;
        padding:0 1em;
        line-height:2em;
        color:#369;
        font-weight:700;
        position:relative
    }
    .tree ul li:before {
        content:"";
        display:block;
        width:10px;
        height:0;
        border-top:1px solid;
        margin-top:-1px;
        position:absolute;
        top:1em;
        left:0
    }
    .tree ul li:last-child:before {
        height:auto;
        top:1em;
        bottom:0
    }
    .indicator {
        margin-right:5px;
    }
    .tree li a {
        text-decoration: none;
        color:#369;
    }
    .tree li button, .tree li button:active, .tree li button:focus {
        text-decoration: none;
        color:#369;
        border:none;
        background:transparent;
        margin:0px 0px 0px 0px;
        padding:0px 0px 0px 0px;
        outline: 0;
    }
</style>

@endsection
