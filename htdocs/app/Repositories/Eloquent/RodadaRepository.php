<?php

namespace App\Repositories\Eloquent;

use App\Model\Rodada;
use App\Repositories\Contracts\RodadaInterface;

class RodadaRepository extends AbstractRepository implements RodadaInterface {

    protected $model = Rodada::class;

    public function create(array $data):Bool{
        $user = auth()->user();
        $listBolao = $user->boloes;
        $bolaoid = $data['bolaoid'];
        $exist = false;
        foreach ($listBolao as $key => $value){
            if ($bolaoid == $value->id){
                $exist = true;
            }
        }

        if ($exist){
            return (bool) $this->model->create($data);
        }else{
            return false;
        }
    }

    public function update(array $data, int $id):Bool{
        $register = $this->find($id);
        if ($register){
            $user = auth()->user();
            $listBolao = $user->boloes;
            $bolaoid = $data['bolaoid'];
            $exist = false;
            foreach ($listBolao as $key => $value){
                if ($bolaoid == $value->id){
                    $exist = true;
                }
            }

            if ($exist) {
                return (bool)$register->update($data);
            }else{
                return false;
            }
        }else{
            return false;
        }
    }


}

?>
