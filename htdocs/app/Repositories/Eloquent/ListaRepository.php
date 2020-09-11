<?php

namespace App\Repositories\Eloquent;

use App\Model\Lista;
use App\Repositories\Contracts\ListaInterface;

class ListaRepository extends AbstractRepository implements ListaInterface {

    protected $model = Lista::class;

}

?>
