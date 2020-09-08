<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Formulario extends Component
{
    public $action;
    public $method;

    public function __construct(string $action, string $method)
    {
        $this->action = $action;
        $this->method = $method;
    }

    public function render()
    {
        return view('components.formulario');
    }
}
