<?php

namespace App\View\Components\form;

use Illuminate\View\Component;

class select extends Component
{
    public $collection;
    public $name;
    public $class;
    public $index;
    public $label;
    public $id;
    public $select;
    public $firstDisabled;
    public $display;
    public $attribute;


    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($collection, $name, $class="", $label="label", $select = null, $index="", $id="", $firstDisabled="true", $display = "name", $attribute="")
    {
        $this->collection = $collection;
        $this->name = $name;
        $this->class = $class;
        $this->index = $index;
        $this->label = $label;
        $this->id = $id;
        $this->select = $select;
        $this->firstDisabled = $firstDisabled;
        $this->display = $display;
        $this->attribute = $attribute;
    }


    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.form.select');
    }
}
