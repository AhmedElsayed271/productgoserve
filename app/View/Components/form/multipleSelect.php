<?php

namespace App\View\Components\form;

use Illuminate\View\Component;

class multipleSelect extends Component
{
    public $collection;
    public $name;
    public $class;
    public $index;
    public $label;
    public $id;
    public $selectArr;
    public $attribute;
    public $display;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($collection, $name, $class, $index, $label, $selectArr, $id="", $attribute="", $display="")
    {
        $this->class = $class;
        $this->id = $id;
        $this->collection = $collection;
        $this->selectArr = $selectArr;
        $this->index = $index;
        $this->name = $name;
        $this->label = $label;
        $this->attribute = $attribute;
        $this->display = $display;
    }


    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.form.multiple-select');
    }
}
