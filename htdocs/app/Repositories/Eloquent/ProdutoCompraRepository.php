<?php

namespace App\Repositories\Eloquent;

use App\Model\ProdutoCompra;
use App\Repositories\Contracts\ProdutoCompraInterface;
use Illuminate\Database\Eloquent\Collection;

class ProdutoCompraRepository extends AbstractRepository implements ProdutoCompraInterface {

    protected $model = ProdutoCompra::class;

    public function all(string $column = 'id', string $order = 'ASC'):Collection
    {
        return $this->model->with('categoria')->orderBy($column, $order)->get();
    }
}

?>
