<?php

namespace App\Repositories\Eloquent;

use App\Model\Imovel;
use App\Repositories\Contracts\ImovelInterface;

class ImovelRepository extends AbstractRepository implements ImovelInterface {

    protected $model = Imovel::class;

    private $location;

    public function find(string $id = '0')
    {
        return $this->model->with('fotos')->with('endereco')->findOrFail($id);
    }

    public function setLocation(array $data): self{
        $this->location = $data;
        return $this;
    }

    public function getResult(){
        $location = $this->location;

        return $this->model->whereHas('endereco', function($q) use($location){
           $q->where('estadoid', $location['estadoid'])
             ->where('cidadeid', $location['cidadeid']);
        });
    }

}

?>
