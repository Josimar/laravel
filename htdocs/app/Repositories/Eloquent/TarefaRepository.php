<?php

namespace App\Repositories\Eloquent;

use App\Model\Tarefa;
use App\Repositories\Contracts\TarefaInterface;

class TarefaRepository extends AbstractRepository implements TarefaInterface {

    protected $model = Tarefa::class;

}

?>
