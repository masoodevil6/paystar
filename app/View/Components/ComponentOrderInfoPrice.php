<?php

namespace App\View\Components;

use Illuminate\View\Component;

class ComponentOrderInfoPrice extends Component
{

    public $infoOrderPrice;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($infoOrderPrice)
    {
        $this->infoOrderPrice = $infoOrderPrice;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.component-order-info-price');
    }
}
