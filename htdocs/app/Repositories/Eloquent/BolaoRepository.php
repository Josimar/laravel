<?php

namespace App\Repositories\Eloquent;

use App\Model\Bolao;
use App\Repositories\Contracts\BolaoInterface;

class BolaoRepository extends AbstractRepository implements BolaoInterface {

    protected $model = Bolao::class;

    public function create(array $data):Bool{
        $user = Auth()->user();
        $data['usuarioid'] = $user->id;
        return (bool) $this->model->create($data);
    }

}

?>
