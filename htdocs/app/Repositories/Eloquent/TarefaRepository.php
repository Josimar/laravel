<?php

namespace App\Repositories\Eloquent;

use App\Model\Tarefa;
use App\Repositories\Contracts\RepositoryInterface;

class TarefaRepository extends AbstractRepository implements RepositoryInterface {

    protected $model = Tarefa::class;

}

?>