<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Breadcrumb extends Component
{
    public $titulo;
    public $caminhos;

    public function __construct(string $titulo, array $caminhos)
    {
        $this->titulo = $titulo;
        $this->caminhos = $caminhos;
    }

    public function render()
    {
        return view('components.breadcrumb');
    }
}
