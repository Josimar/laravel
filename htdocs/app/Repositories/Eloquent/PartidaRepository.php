<?php

namespace App\Repositories\Eloquent;

use App\Model\Partida;
use App\Repositories\Contracts\PartidaInterface;

class PartidaRepository extends AbstractRepository implements PartidaInterface {

    protected $model = Partida::class;

}

?>
