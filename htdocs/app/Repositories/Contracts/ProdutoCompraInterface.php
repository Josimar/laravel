<?php

namespace App\Repositories\Contracts;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

interface ProdutoCompraInterface{
    public function selectFilter(Request $request);
    public function selectCondition(Request $request);
    public function getResult();
    public function all(string $column = 'id', string $order = 'ASC'):Collection;
    public function find(string $id = '0');
    public function findField(string $field, string $sign, string $value);
    public function paginate(int $paginate = 10, string $column = 'id', string $order = 'ASC'):LengthAwarePaginator;
    public function findPaginate(int $paginate = 10, string $id = '0', string $column = 'id', string $order = 'ASC'):LengthAwarePaginator;
    public function findWhereLike(array $columns, string $search, string $column = 'id', string $order = 'ASC'):Collection;

    public function save(array $data);

    public function create(array $data): Bool;
    public function update(array $data, int $id): Bool;
    public function delete(int $id): Bool;
}

?>
