<?php

namespace App\Repositories\Eloquent;

use App\Model\CategoriaCompra;
use App\Repositories\Contracts\CategoriaCompraInterface;
use Illuminate\Http\Request;

class CategoriaCompraRepository extends AbstractRepository implements CategoriaCompraInterface {

    protected $model = CategoriaCompra::class;

    public function selectCondition(Request $request, $usuario = null){
        if ($request->has('conditions')){
            $conditions = explode(';', $request->get('conditions'));

            foreach ($conditions as $condition){
                $where = explode(':', $condition);
                $this->model = $this->model->where($where[0], $where[1], $where[2]);
            }

            if ($usuario != null){
                $this->model = $usuario->categoriacompra;
            }
        }else{
            if ($usuario != null){
                $this->model = $usuario->categoriacompra;
            }
        }
    }

}

?>
