<?php

namespace App\View\Components\form;

use Illuminate\View\Component;

class textarea extends Component
{
    public $name;
    public $class;
    public $value;
    public $label;
    public $attribute;
    public $key;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($class, $name ="test", $value, $label ="", $attribute="", $key="")
    {
        $this->class = $class;
        $this->attribute = $attribute;
        $this->label = $label;
        $this->name = $name;
        $this->value = $value;
        $this->key = $key;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.form.textarea');
    }
}
