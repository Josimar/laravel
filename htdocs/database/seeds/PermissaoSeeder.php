<?php

use Illuminate\Database\Seeder;
use App\Model\Permissao;

class PermissaoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $u1 = Permissao::firstOrCreate([
            'nome' => 'usuario-view',
            'descricao' => 'Acesso a lista de usuários',
        ]);
        $u2 = Permissao::firstOrCreate([
            'nome' => 'usuario-create',
            'descricao' => 'Adicionar usuário',
        ]);
        $u3 = Permissao::firstOrCreate([
            'nome' => 'usuario-edit',
            'descricao' => 'Editar usuário',
        ]);
        $u4 = Permissao::firstOrCreate([
            'nome' => 'usuario-delete',
            'descricao' => 'Excluir usuário',
        ]);
        $p1 = Permissao::firstOrCreate([
            'nome' => 'papel-view',
            'descricao' => 'Acesso a lista de papeis',
        ]);
        $p2 = Permissao::firstOrCreate([
            'nome' => 'papel-create',
            'descricao' => 'Adicionar papel',
        ]);
        $p3 = Permissao::firstOrCreate([
            'nome' => 'papel-edit',
            'descricao' => 'Editar papel',
        ]);
        $p4 = Permissao::firstOrCreate([
            'nome' => 'papel-delete',
            'descricao' => 'Excluir papel',
        ]);
        $f1 = Permissao::firstOrCreate([
            'nome' => 'favoritos-view',
            'descricao' => 'Acesso a lista de favoritos',
        ]);
        $f2 = Permissao::firstOrCreate([
            'nome' => 'favoritos-create',
            'descricao' => 'Adicionar favorito',
        ]);
        $f3 = Permissao::firstOrCreate([
            'nome' => 'favoritos-edit',
            'descricao' => 'Editar favorito',
        ]);
        $f4 = Permissao::firstOrCreate([
            'nome' => 'favoritos-delete',
            'descricao' => 'Excluir favoritos',
        ]);
        $c1 = Permissao::firstOrCreate([
            'nome' => 'chamados-view',
            'descricao' => 'Acesso a lista de chamados',
        ]);
        $c2 = Permissao::firstOrCreate([
            'nome' => 'chamados-create',
            'descricao' => 'Adicionar chamado',
        ]);
        $c3 = Permissao::firstOrCreate([
            'nome' => 'chamados-edit',
            'descricao' => 'Editar chamado',
        ]);
        $c4 = Permissao::firstOrCreate([
            'nome' => 'chamados-delete',
            'descricao' => 'Excluir chamado',
        ]);
        $perfil1 = Permissao::firstOrCreate([
            'nome' => 'perfil-view',
            'descricao' => 'Acesso ao perfil',
        ]);
        
        echo "Registros de permissao criados com sucesso";
    }
}
