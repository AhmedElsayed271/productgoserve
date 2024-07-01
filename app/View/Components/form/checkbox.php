<?php

namespace App\View\Components\form;

use Illuminate\View\Component;

class checkbox extends Component
{
    public $class;
    public $name;
    public $label;
    public $tag;
    public $value;
    public $attribute;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($class,$name,$label,$tag,$value,$attribute)
    {
        $this->class = $class;
        $this->name = $name;
        $this->label = $label;
        $this->tag = $tag;
        $this->value = $value;
        $this->attribute = $attribute;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.form.checkbox');
    }
}
