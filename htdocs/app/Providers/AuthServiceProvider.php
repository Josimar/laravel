<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

use App\Model\Chamado;
use App\Model\Permissao;
use App\Model\Papel;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model\Chamado' => 'App\Policies\ChamadoPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        foreach($this->listaPermissoes() as $permissao){
            Gate::define($permissao->nome, function($user) use($permissao){
                return $user->ehAdmin() || $user->temPermissao($permissao->papeis);
            });
        }
        
    }

    public function listaPermissoes(){
        return Permissao::with('papeis')->get();
    }
}
