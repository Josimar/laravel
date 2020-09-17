<?php

namespace App\Repositories\Eloquent;

use App\Model\Transporte;
use Illuminate\Http\Request;
use App\Repositories\Contracts\TransporteInterface;

class TransporteRepository extends AbstractRepository implements TransporteInterface {

    protected $model = Transporte::class;

}

?>
