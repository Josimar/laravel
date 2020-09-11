<?php

namespace App\Repositories\Eloquent;

use App\Model\Categoria;
use App\Repositories\Contracts\CategoriaInterface;

class CategoriaRepository extends AbstractRepository implements CategoriaInterface {

    protected $model = Categoria::class;

}

?>
