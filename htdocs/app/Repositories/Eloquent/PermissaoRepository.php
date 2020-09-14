<?php

namespace App\Repositories\Eloquent;

use App\Model\Permissao;
use App\Repositories\Contracts\PermissaoInterface;

class PermissaoRepository extends AbstractRepository implements PermissaoInterface {

    protected $model = Permissao::class;

}

?>
