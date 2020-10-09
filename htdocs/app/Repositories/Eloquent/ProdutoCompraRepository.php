<?php

namespace App\Repositories\Eloquent;

use App\Model\ProdutoCompra;
use App\Repositories\Contracts\ProdutoCompraInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class ProdutoCompraRepository extends AbstractRepository implements ProdutoCompraInterface {

    protected $model = ProdutoCompra::class;

    public function all(string $column = 'id', string $order = 'ASC'):Collection
    {
        return $this->model->with('categoria')->orderBy($column, $order)->get();
    }

    public function selectCondition(Request $request, $usuario = null){
        if ($request->has('conditions')){
            $conditions = explode(';', $request->get('conditions'));

            foreach ($conditions as $condition){
                $where = explode(':', $condition);
                $this->model = $this->model->where($where[0], $where[1], $where[2]);
            }

            if ($usuario != null){
                $this->model = $usuario->produtocompra;
            }
        }else{
            if ($usuario != null){
                $this->model = $usuario->produtocompra;
            }
        }
    }
}

?>
