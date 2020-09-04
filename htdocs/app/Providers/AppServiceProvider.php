<?php

namespace App\Providers;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('App\Repositories\Contracts\RepositoryInterface', 'App\Repositories\Eloquent\UsuarioRepository');
        $this->app->bind('App\Repositories\Contracts\RepositoryInterface', 'App\Repositories\Eloquent\TarefaRepository');
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Blade::component('components.alert', 'alert');

        // JsonResource::withoutWrapping();
        // JsonResource::wrap('dados');
    }
}
