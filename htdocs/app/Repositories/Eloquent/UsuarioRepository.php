<?php

namespace App\Repositories\Eloquent;

use App\User;
use App\Repositories\Contracts\UsuarioInterface;

class UsuarioRepository extends AbstractRepository implements UsuarioInterface {

    protected $model = User::class;

    public function create(array $data):Bool{
        $register = $this->model->create($data);
        if (isset($data['papeis']) && count($data['papeis'])){
            foreach ($data['papeis'] as $key => $value){
                $register->papeis()->attach($value);
            }
        }
        return (bool) $register;
    }

    public function update(array $data, int $id):Bool{
        $register = $this->model->find($id);
        if ($register){
            $papeis = $register->papeis;
            if (count($papeis)){
                foreach ($papeis as $key => $value){
                    $register->papeis()->detach($value->id);
                }
            }
            if (isset($data['papeis']) && count($data['papeis'])){
                foreach ($data['papeis'] as $key => $value){
                    $register->papeis()->attach($value);
                }
            }
            return (bool) $register->update($data);
        }else{
            return false;
        }
    }

}

?>
