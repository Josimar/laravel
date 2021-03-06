<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\Database\Eloquent\Collection;

class Layout extends Component
{
    public $routeName;
    public $titulo;
    public $search;
    public $mode;
    public $caminhos;
    public $columnList;
    public $recordsetList;
    public $recordsetItem;
    public $tableNomeIdList;
    public $orderlist;

    public function __construct(string $routeName, string $titulo, string $search, string $mode, array $caminhos,
                                array $columnList, Collection $recordsetList, string $recordsetItem,
                                array $tableNomeIdList, string $orderlist)
    {
        $this->routeName = $routeName;
        $this->titulo = $titulo;
        $this->search = $search;
        $this->mode = $mode;
        $this->caminhos = $caminhos;
        $this->columnList = $columnList;
        $this->recordsetList = $recordsetList;
        $this->recordsetItem = $recordsetItem;
        $this->tableNomeIdList = $tableNomeIdList;
        $this->orderlist = $orderlist;
    }

    public function render()
    {
        return view('components.layout');
    }
}
