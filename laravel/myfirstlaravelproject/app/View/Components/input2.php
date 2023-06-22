<?php

namespace App\View\Components;

use Closure;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class input2 extends Component
{
    public $type;

    public $name;

    public $id;

    public $label;

    /**
     * Create a new component instance.
     */
    public function __construct($type, $label, $name, $id)
    {
        $this->label = $label;
        $this->type = $type;
        $this->name = $name;
        $this->id = $id;

    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.input2');
    }
}