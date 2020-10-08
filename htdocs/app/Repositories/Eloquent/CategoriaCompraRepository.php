<?php

namespace App\Repositories\Eloquent;

use App\Model\CategoriaCompra;
use App\Repositories\Contracts\CategoriaCompraInterface;

class CategoriaCompraRepository extends AbstractRepository implements CategoriaCompraInterface {

    protected $model = CategoriaCompra::class;

}

?>
