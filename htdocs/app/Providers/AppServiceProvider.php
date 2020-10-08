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
        $this->app->bind('App\Repositories\Contracts\SistemaInterface', 'App\Repositories\Eloquent\SistemaRepository');
        $this->app->bind('App\Repositories\Contracts\PermissaoInterface', 'App\Repositories\Eloquent\PermissaoRepository');
        $this->app->bind('App\Repositories\Contracts\PapelInterface', 'App\Repositories\Eloquent\PapelRepository');
        $this->app->bind('App\Repositories\Contracts\TarefaInterface', 'App\Repositories\Eloquent\TarefaRepository');
        $this->app->bind('App\Repositories\Contracts\ListaInterface', 'App\Repositories\Eloquent\ListaRepository');
        $this->app->bind('App\Repositories\Contracts\ListaCompraInterface', 'App\Repositories\Eloquent\ListaCompraRepository');
        $this->app->bind('App\Repositories\Contracts\CategoriaInterface', 'App\Repositories\Eloquent\CategoriaRepository');
        $this->app->bind('App\Repositories\Contracts\CategoriaCompraInterface', 'App\Repositories\Eloquent\CategoriaCompraRepository');
        $this->app->bind('App\Repositories\Contracts\ProdutoInterface', 'App\Repositories\Eloquent\ProdutoRepository');
        $this->app->bind('App\Repositories\Contracts\ProdutoCompraInterface', 'App\Repositories\Eloquent\ProdutoCompraRepository');
        $this->app->bind('App\Repositories\Contracts\TransporteInterface', 'App\Repositories\Eloquent\TransporteRepository');
        $this->app->bind('App\Repositories\Contracts\ImovelInterface', 'App\Repositories\Eloquent\ImovelRepository');
        $this->app->bind('App\Repositories\Contracts\ImovelFotoInterface', 'App\Repositories\Eloquent\ImovelFotoRepository');
        $this->app->bind('App\Repositories\Contracts\BolaoInterface', 'App\Repositories\Eloquent\BolaoRepository');
        $this->app->bind('App\Repositories\Contracts\RodadaInterface', 'App\Repositories\Eloquent\RodadaRepository');
        $this->app->bind('App\Repositories\Contracts\PartidaInterface', 'App\Repositories\Eloquent\PartidaRepository');

    }

    public function boot()
    {
        // JsonResource::withoutWrapping();
        // JsonResource::wrap('dados');
    }
}
