<?php

namespace App\Repositories\Eloquent;

use App\Model\BolaoUsuarioPartida;
use App\Model\Partida;
use App\Repositories\Contracts\PartidaInterface;

class PartidaRepository extends AbstractRepository implements PartidaInterface {

    protected $model = Partida::class;

    public function create(array $data):Bool{
        $user = auth()->user();
        $listRodadas = $user->rodadas;
        $rodadaid = $data['rodadaid'];
        $exist = false;
        foreach ($listRodadas as $key => $value){
            if ($rodadaid == $value->id){
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
        $registro = $this->find($id);
        if ($registro){
            $user = auth()->user();
            $listRodadas = $user->rodadas;
            $rodadaid = $data['rodadaid'];
            $exist = false;
            foreach ($listRodadas as $key => $value){
                if ($rodadaid == $value->id){
                    $exist = true;
                }
            }

            if ($exist) {
                $this->calculatePoints($registro);
                return (bool)$registro->update($data);
            }else{
                return false;
            }
        }else{
            return false;
        }
    }

    public function calculatePoints($partida){
        $bolao = $partida->rodada->bolao;
        $apostadores = $bolao->apostadores;
        $now = now();

        foreach ($apostadores as $user) {
            $taxa = 0;
            $pontos = 0;
            $roundTitle = '';
            foreach ($bolao->rodadas as $key => $roundValue) {
                if ($roundValue->datafinal < $now ) {
                    $roundTitle = $roundValue->titulo;
                    foreach ($roundValue->partidas as $matchValue) {
                        if ($user->partidas->contains($matchValue)) {
                            $bet = $user->partidas()->find($matchValue->id);
                            $pontos += $bet->result === $bet->pivot->resultado ? $bolao->pontosresultado + $taxa : 0;
                            $pontos += $bet->placara === $bet->pivot->placara &&
                            $bet->placarb === $bet->pivot->placarb ? $bolao->pontosextra + $taxa : 0;
                        }
                    }
                }

                $taxa += $bolao->pontostaxa;
            }

            $bolao->rodadaatual = $roundTitle;
            $bolao->save();

            $user->meusBoloes()->updateExistingPivot(
                $bolao,
                [
                    'pontos' => $pontos
                ]
            );
        }
    }

    public function partida($partidaid){
        $user = auth()->user();
        $partida = $user->partidas()->find($partidaid);
        if ($partida){
            return $partida;
        }
        $partida = Partida::find($partidaid);
        $bolaoid = $partida->rodada->bolao->id;
        $bolao = $user->meusBoloes()->find($bolaoid);
        if ($bolao){
            return $partida;
        }

        return false;
    }

    public function PartidaUsuarioSave($partidaid, $registro){
        $user = auth()->user();
        $partida = $user->partidas()->find($partidaid);
        if (!$partida) {
            $partida = Partida::find($partidaid);
        }
        $bolaoid = $partida->rodada->bolao->id;
        $bolao = $user->meusBoloes()->find($bolaoid);
        if($bolao){
            $resultado = $registro['placara'] > $registro['placarb'] ? 'A' :
                $registro['placara'] === $registro['placarb'] ? 'E' : 'B';

            $ret = $partida->usuarios()->updateExistingPivot(
                $user,
                ['resultado' => $resultado, 'placara' => $registro['placara'], 'placarb' => $registro['placarb']]
            );
            if ($ret) {
                return $partida;
            } else {
                $ret = BolaoUsuarioPartida::updateOrCreate(
                    ['usuarioid' => $user->id, 'partidaid' => $partida->id],
                    ['resultado' => $resultado, 'placara' => $registro['placara'], 'placarb' => $registro['placarb']]
                );

                if ($ret) {
                    return $partida;
                }
            }
        }

        return false;
    }

}

?>
