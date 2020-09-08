<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\Pagination\LengthAwarePaginator;

class Tabela extends Component
{
    public $columnList;
    public $recordsetList;

    public function __construct(array $columnList, LengthAwarePaginator $recordsetList)
    {
        $this->columnList = $columnList;
        $this->recordsetList = $recordsetList;
    }

    public function render()
    {
        return view('components.tabela');
    }
}
