<?php

namespace App\Repositories\Eloquent;

use App\Model\ImovelFotos;
use App\Repositories\Contracts\ImovelFotoInterface;

class ImovelFotoRepository extends AbstractRepository implements ImovelFotoInterface {

    protected $model = ImovelFotos::class;

}

?>
