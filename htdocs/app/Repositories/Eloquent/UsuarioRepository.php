<?php

namespace App\Repositories\Eloquent;

use App\User;
use App\Repositories\Contracts\RepositoryInterface;

class UsuarioRepository extends AbstractRepository implements RepositoryInterface {

    protected $model = User::class;

}

?>