<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Alert extends Component
{
    public $message;
    public $status;

    public function __construct(string $message, string $status)
    {
        $this->message = $message;
        $this->status = $status;
    }

    public function render()
    {
        return view('components.alert');
    }
}
