<?php

namespace App\Repositories\Eloquent;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

abstract class AbstractRepository{

    protected $model;

    function __construct(){
        $this->model = $this->resolveModel();
    }

    protected function resolveModel(){
        return app($this->model);
    }

    public function selectFilter(Request $request){
        if ($request->has('fields')){
            $fields = $request->get('fields');
            $this->model = $this->model->selectRaw($fields);
        }
    }

    public function selectCondition(Request $request){
        if ($request->has('conditions')){
            $conditions = explode(';', $request->get('conditions'));

            foreach ($conditions as $condition){
                $where = explode(':', $condition);
                $this->model = $this->model->where($where[0], $where[1], $where[2]);
            }
        }
    }

    public function getResult(){
        return $this->model;
    }

    public function all(string $column = 'id', string $order = 'ASC'):Collection
    {
      return $this->model->orderBy($column, $order)->get();
    }

    public function find(string $id = '0')
    {
      return $this->model->findOrFail($id);
    }

    public function paginate(int $paginate = 10, string $column = 'id', string $order = 'ASC'):LengthAwarePaginator
    {
      return $this->model->orderBy($column, $order)->paginate($paginate);
    }

    public function findPaginate(int $paginate = 10, string $id = '0', string $column = 'id', string $order = 'ASC'):LengthAwarePaginator
    {
        return $this->model->where('id', '=', $id)->orderBy($column, $order)->paginate($paginate);
    }

    public function findWhereLike(array $columns, string $search, string $column = 'id', string $order = 'ASC'):Collection{
        $query = $this->model;

        foreach ($columns as $key => $value){
            $query = $query->orWhere($value, 'like', '%'.$search.'%');
        }

        return $query->orderBy($column, $order)->get();
    }

    public function save(array $data){
        return $this->model->create($data);
    }

    public function create(array $data): Bool{
        return (bool) $this->model->create($data);
    }

    public function update(array $data, int $id): Bool{
        $registro = $this->find($id);
        if ($registro){
            return (bool) $registro->update($data);
        }else{
            return false;
        }
    }

    public function delete(int $id): Bool{
        $registro = $this->find($id);
        if ($registro){
            return (bool) $registro->delete();
        }else{
            return false;
        }
    }


}

?>
