<?php

namespace App\Repositories\Eloquent;

use App\User;
use App\Repositories\Contracts\UsuarioInterface;

class UsuarioRepository extends AbstractRepository implements UsuarioInterface {

    protected $model = User::class;

}

?>
