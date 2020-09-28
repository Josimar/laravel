<?php

namespace App\Repositories\Eloquent;

use App\Model\Produto;
use App\Repositories\Contracts\ProdutoInterface;
use Illuminate\Database\Eloquent\Collection;

class ProdutoRepository extends AbstractRepository implements ProdutoInterface {

    protected $model = Produto::class;

    public function all(string $column = 'id', string $order = 'ASC'):Collection
    {
        return $this->model->with('categoria')->orderBy($column, $order)->get();
    }
}

?>
