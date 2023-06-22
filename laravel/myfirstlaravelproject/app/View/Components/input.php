<?php

namespace App\View\Components;

use Closure;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class input extends Component
{
    public $type;
    public $name;
    public $label;



    /**
     * Create a new component instance.
     */
    public function __construct($type, $name, $label)
    {
        $this->type = $type;
        $this->name = $name;
        $this->label = $label;

    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.input');
    }
}