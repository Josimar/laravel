<?php

namespace App\Repositories\Eloquent;

use App\Model\Sistema;
use App\Repositories\Contracts\SistemaInterface;

class SistemaRepository extends AbstractRepository implements SistemaInterface {

    protected $model = Sistema::class;

    public function find(string $id = '0')
    {
        return $this->model->with('categorias')->findOrFail($id);
    }

}

?>
