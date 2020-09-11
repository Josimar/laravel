<?php

namespace App\Providers;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;

class AppServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind('App\Repositories\Contracts\UsuarioInterface', 'App\Repositories\Eloquent\UsuarioRepository');
        $this->app->bind('App\Repositories\Contracts\TarefaInterface', 'App\Repositories\Eloquent\TarefaRepository');
        $this->app->bind('App\Repositories\Contracts\ListaInterface', 'App\Repositories\Eloquent\ListaRepository');
        $this->app->bind('App\Repositories\Contracts\CategoriaInterface', 'App\Repositories\Eloquent\CategoriaRepository');
        $this->app->bind('App\Repositories\Contracts\ProdutoInterface', 'App\Repositories\Eloquent\ProdutoRepository');
    }

    public function boot()
    {
        // JsonResource::withoutWrapping();
        // JsonResource::wrap('dados');
    }
}
