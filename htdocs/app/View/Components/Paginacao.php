<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\Pagination\LengthAwarePaginator;

class Paginacao extends Component
{
    public $titulo;
    public $search;
    public $recordsetList;

    public function __construct(string $titulo, string $search, LengthAwarePaginator $recordsetList)
    {
        $this->titulo = $titulo;
        $this->search = $search;
        $this->recordsetList = $recordsetList;
    }

    public function render()
    {
        return view('components.paginacao');
    }
}
