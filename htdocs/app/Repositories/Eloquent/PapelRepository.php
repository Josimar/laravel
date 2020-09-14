<?php

namespace App\Repositories\Eloquent;

use App\Model\Papel;
use App\Repositories\Contracts\PapelInterface;

class PapelRepository extends AbstractRepository implements PapelInterface {

    protected $model = Papel::class;

    public function create(array $data):Bool{
        $register = $this->model->create($data);
        if (isset($data['permissoes']) && count($data['permissoes'])){
            foreach ($data['permissoes'] as $key => $value){
                $register->permissoes()->attach($value);
            }
        }
        return (bool) $register;
    }

    public function update(array $data, int $id):Bool{
        $register = $this->model->find($id);
        if ($register){
            $permissoes = $register->permissoes;
            if (count($permissoes)){
                foreach ($permissoes as $key => $value){
                    $register->permissoes()->detach($value->id);
                }
            }
            if (isset($data['permissoes']) && count($data['permissoes'])){
                foreach ($data['permissoes'] as $key => $value){
                    $register->permissoes()->attach($value);
                }
            }
            return (bool) $register->update($data);
        }else{
            return false;
        }
    }

}

?>
