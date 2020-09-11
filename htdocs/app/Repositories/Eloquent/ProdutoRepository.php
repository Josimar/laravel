<?php

namespace App\Repositories\Eloquent;

use App\Model\Produto;
use App\Repositories\Contracts\ProdutoInterface;

class ProdutoRepository extends AbstractRepository implements ProdutoInterface {

    protected $model = Produto::class;

}

?>
