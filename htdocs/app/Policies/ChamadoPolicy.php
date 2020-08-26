<?php

namespace App\Policies;

use App\Model\Chamado;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ChamadoPolicy
{
    use HandlesAuthorization;

    public function before($user, $ability){
        if ($user->ehAdmin()){
            return true;
        }
    }

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\User  $user
     * @param  \App\Chamado  $chamado
     * @return mixed
     */
    public function view(User $user, Chamado $chamado)
    {
        return $user->id == $chamado->userid;
    }

    public function create(User $user)
    {
        return true;
    }

    public function update(User $user, Chamado $chamado)
    {
        return $user->id == $chamado->userid;
    }

    public function delete(User $user, Chamado $chamado)
    {
        return $user->id == $chamado->userid;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\User  $user
     * @param  \App\Chamado  $chamado
     * @return mixed
     */
    public function restore(User $user, Chamado $chamado)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\Chamado  $chamado
     * @return mixed
     */
    public function forceDelete(User $user, Chamado $chamado)
    {
        //
    }
}
