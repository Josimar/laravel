@extends('layouts.app')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                <h1>{{ __('controle.listUser') }}</h1>
                </div>
                <div class="col-sm-6">
                    @include('admin.breadcrumb')
                </div>
            </div>
            </div><!-- /.container-fluid -->
        </section>

        <section class="content">
            <div class="card card-solid">
              <div class="card-body pb-0">
                <div class="row d-flex align-items-stretch">
                  
                    @foreach($usuarios as $key => $usuario)
                    <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch">
                        <div class="card bg-light">
                            <div class="card-header text-muted border-bottom-0">
                                {{ $usuario->id }}
                            </div>
                            <div class="card-body pt-0">
                                <div class="row">
                                <div class="col-7">
                                    <h2 class="lead"><b>{{ $usuario->name }}</b></h2>
                                    <!--<p class="text-muted text-sm"><b>About: </b> Web Designer / UX / Graphic Artist / Coffee Lover </p>-->
                                    <ul class="ml-4 mb-0 fa-ul text-muted">
                                    <li class="small"><span class="fa-li"><i class="fas fa-lg fa-building"></i></span> {{ $usuario->email }}</li>
                                    <!--<li class="small"><span class="fa-li"><i class="fas fa-lg fa-phone"></i></span> Phone #: + 800 - 12 12 23 52</li>-->
                                    </ul>
                                </div>
                                <div class="col-5 text-center">
                                    <img src="{{ URL::asset('img/user_128.jpg') }}" alt="" class="img-circle img-fluid">
                                </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="text-right">
                                <a href="#" class="btn btn-sm bg-teal">
                                    <i class="fas fa-comments"></i>
                                </a>
                                <a href="{{route('usuarios.papel', $usuario->id)}}" class="btn btn-sm btn-primary">
                                    <i class="fas fa-user"></i> View
                                </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach

                </div>
              </div>
              
              @if(!$search && $usuarios)
                <div class="card-footer">
                    {{$usuarios->links()}}
                </div>
              @endif
            </div>
          </section>
    </div>
@endsection