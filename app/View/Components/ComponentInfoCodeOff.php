<?php

namespace App\View\Components;

use Illuminate\View\Component;

class ComponentInfoCodeOff extends Component
{

    public $codeOff;
    public $codeOffPrice;
    public $codeOffPricePass;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($codeOff , $codeOffPrice , $codeOffPricePass)
    {
        $this->codeOff= $codeOff;
        $this->codeOffPrice= $codeOffPrice;
        $this->codeOffPricePass= $codeOffPricePass;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.component-info-code-off');
    }
}
