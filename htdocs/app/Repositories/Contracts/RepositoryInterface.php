<?php

namespace App\Repositories\Contracts;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

interface RepositoryInterface{
    public function all(string $column = 'id', string $order = 'ASC'):Collection;
    public function find(string $id = '0');
    public function paginate(int $paginate = 10, string $column = 'id', string $order = 'ASC'):LengthAwarePaginator;
    public function findWhereLike(array $columns, string $search, string $column = 'id', string $order = 'ASC'):Collection;
}

?>