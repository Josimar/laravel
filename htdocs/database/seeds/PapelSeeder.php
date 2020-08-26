<?php

use Illuminate\Database\Seeder;

use App\Model\Papel;

class PapelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $p1 = Papel::firstOrCreate([
            'nome' => 'Admin',
            'descricao' => 'Acesso total ao sistema'
        ]);
        $p2 = Papel::firstOrCreate([
            'nome' => 'Gerente',
            'descricao' => 'Gerencimanto do sistema'
        ]);
        $p3 = Papel::firstOrCreate([
            'nome' => 'Usuario',
            'descricao' => 'Usuário do sistema'
        ]);

        echo "Papeis criados com Sucesso";
    }
}
