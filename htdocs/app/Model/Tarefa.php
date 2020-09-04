<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tarefa extends Model
{
    use SoftDeletes;

    protected $table = 'tarefas';
    const CREATED_AT = 'createdAt';
    const UPDATED_AT = 'updatedAt';
    const DELETED_AT = 'deletedAt';

    protected $fillable = [
        'tarefaid', 'empresaid', 'projetoid', 'prioridadeid', 'categoriaid', 'usuarioid', 
        'descricao', 'duedate', 'complete', 'titulo', 'percentcomplete', 'startdate',
        'anexos', 'statusid', 'assignto', 'icon', 'imageurl', 'overdue', 'completedAt'
    ];
}
