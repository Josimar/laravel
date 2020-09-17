<?php

namespace App\Repositories\Eloquent;

use App\Model\Imovel;
use App\Repositories\Contracts\ImovelInterface;

class ImovelRepository extends AbstractRepository implements ImovelInterface {

    protected $model = Imovel::class;

}

?>
