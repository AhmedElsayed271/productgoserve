<?php

namespace App\View\Components\form;

use Illuminate\View\Component;

class map extends Component
{

    public $label;
    public $latName;
    public $longName;
    public $latValue;
    public $longValue;
    public $name;
    public $showInput;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($label,$latName, $longName,$latValue,$longValue, $name, $showInput = "true")
    {
        $this->label = $label;
        $this->latName = $latName;
        $this->longName = $longName;
        $this->latValue = $latValue;
        $this->longValue = $longValue;
        $this->name = $name;
        $this->showInput = $showInput;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.form.map');
    }
}
