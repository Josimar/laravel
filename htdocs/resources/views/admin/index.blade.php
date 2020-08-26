@extends('layouts.app')

@section('content')
<div class="container">

    @include('admin._breadcrumb')

    <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0 text-dark">{{ __('Área restrita') }}</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">{{ __('Área restrita') }}</a></li>
                <li class="breadcrumb-item active">{{ __('Dashboard') }}</li>
              </ol>
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>

        <div class="row">

            @can('usuario-view')
            <div class="col-lg-3 col-6">
                <div class="small-box bg-dark">
                    <div class="inner">
                    <h3>{{__('Usuários')}}</h3>
                    <p>{{__('usuários do sistema')}}</p>
                    </div>
                    <div class="icon">
                    <i class="ion ion-stats-bars"></i>
                    </div>
                    <a href="{{route('usuarios.index')}}" class="small-box-footer">{{__('Visualizar')}} <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            @endcan

            @can('favoritos-view')
            <div class="col-lg-3 col-6">
                <div class="small-box bg-dark">
                    <div class="inner">
                    <h3>{{__('Favoritos')}}</h3>
                    <p>{{__('lista de transporte favoritos')}}</p>
                    </div>
                    <div class="icon">
                    <i class="ion ion-stats-bars"></i>
                    </div>
                    <a href="#" class="small-box-footer">{{__('Visualizar')}} <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            @endcan

            @can('perfil-view')
            <div class="col-lg-3 col-6">
                <div class="small-box bg-dark">
                    <div class="inner">
                    <h3>{{__('Perfil')}}</h3>
                    <p>{{__('Alterar dados do perfil')}}</p>
                    </div>
                    <div class="icon">
                    <i class="ion ion-stats-bars"></i>
                    </div>
                    <a href="#" class="small-box-footer">{{__('Visualizar')}} <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            @endcan

            @can('papel-view')
            <div class="col-lg-3 col-6">
                <div class="small-box bg-dark">
                    <div class="inner">
                    <h3>{{__('Papéis')}}</h3>
                    <p>{{__('Listar papéis do sistema')}}</p>
                    </div>
                    <div class="icon">
                    <i class="ion ion-stats-bars"></i>
                    </div>
                    <a href="{{route('papeis.index')}}" class="small-box-footer">{{__('Visualizar')}} <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            @endcan

        </div>
    </div>
</div>
@endsection
