<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\Pagination\LengthAwarePaginator;

class Pagina extends Component
{
    public $page;
    public $search;
    public $caminhos;
    public $columnList;
    public $recordsetList;

    public function __construct(string $page, string $search, array $caminhos, array $columnList, LengthAwarePaginator $recordsetList)
    {
        $this->page = $page;
        $this->search = $search;
        $this->caminhos = $caminhos;
        $this->columnList = $columnList;
        $this->recordsetList = $recordsetList;
    }

    public function render()
    {
        return view('components.pagina');
    }
}
