<?php

namespace App\Repositories\Eloquent;

use App\Model\Bolao;
use App\Model\Rodada;
use App\Repositories\Contracts\BolaoInterface;
use Illuminate\Database\Eloquent\Collection;

class BolaoRepository extends AbstractRepository implements BolaoInterface {

    protected $model = Bolao::class;

    public function list(string $column = 'id', string $order = 'ASC'):Collection{
        $list = Bolao::all();
        $user = Auth()->user();
        if ($user){
            $meuBolao = $user->meusBoloes;
            foreach ($list as $key => $value){
                if ($meuBolao->contains($value)){
                    $value->subscriber = true;
                }
            }
        }

        return $list;
    }

    public function create(array $data):Bool{
        $user = Auth()->user();
        $data['usuarioid'] = $user->id;
        return (bool) $this->model->create($data);
    }

    public function update(array $data, int $id):Bool{
        $register = $this->find($id);
        if ($register){
            $user = Auth()->user();
            $data['usuarioid'] = $user->id;
            return (bool) $this->model->update($data);
        }else{
            return false;
        }
    }

    public function BolaoUsuario($id){
        $user = Auth()->user();
        $bolao = Bolao::find($id);

        if ($bolao){
            $ret = $user->meusBoloes()->toggle($bolao->id);
            if (count($ret['attached'])){
                return true;
            }
        }
        return false;
    }

    public function rodadas($bolaoid){
        $user = Auth()->user();
        $bolao = $user->meusBoloes->find($bolaoid);

        if ($bolao){
            return $bolao->rodadas()->get();
        }
        return false;
    }

    public function bolaoByRodada($rodadaid){
        $bolao = Rodada::find($rodadaid);
        if ($bolao){
            return $bolao->bolao;
        }
        return false;
    }

    public function partidas($rodadaid){
        $user = Auth()->user();
        $rodada = Rodada::find($rodadaid);
        if (!$rodada){
            return false;
        }
        $bolaoid = $rodada->bolao->id;
        $bolao = $user->meusBoloes->find($bolaoid);
        if ($bolao){
            return $rodada->partidas()->get();
        }
        return false;
    }

    public function classification($bolaoid) {
        $bolao = Bolao::find($bolaoid);
        $apostadores = $bolao->Apostadores()->orderBy('pivot_pontos', 'DESC')->get();
        return $apostadores;
    }

}

?>
