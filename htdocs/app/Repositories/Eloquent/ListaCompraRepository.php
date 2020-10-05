<?php

namespace App\Repositories\Eloquent;

use App\Model\ListaCompra;
use App\Repositories\Contracts\ListaCompraInterface;

class ListaCompraRepository extends AbstractRepository implements ListaCompraInterface {

    protected $model = ListaCompra::class;


}

?>
