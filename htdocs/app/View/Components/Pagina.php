<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\Pagination\LengthAwarePaginator;

class Pagina extends Component
{
    public $page;
    public $search;
    public $caminhos;
    public $routeName;
    public $delete;
    public $columnList;
    public $recordsetList;
    public $recordsetItem;
    public $msgMessage;
    public $msgStatus;

    public function __construct(string $page, string $search, array $caminhos, string $routeName, string $delete,
                                array $columnList, string $recordsetList, string $recordsetItem,
                                string $msgMessage, string $msgStatus)
    {
        $this->page = $page;
        $this->search = $search;
        $this->caminhos = $caminhos;
        $this->routeName = $routeName;
        $this->delete = $delete;
        $this->columnList = $columnList;
        $this->recordsetList = $recordsetList;
        $this->recordsetItem = $recordsetItem;
        $this->msgMessage = $msgMessage;
        $this->msgStatus = $msgStatus;
    }

    public function render()
    {
        return view('components.pagina');
    }
}
