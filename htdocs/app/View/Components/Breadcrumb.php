<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Breadcrumb extends Component
{
    public $caminhos;

    public function __construct(array $caminhos)
    {
        $this->caminhos = $caminhos;
    }

    public function render()
    {
        return view('components.breadcrumb');
    }
}
