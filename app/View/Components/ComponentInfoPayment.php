<?php

namespace App\View\Components;

use Illuminate\View\Component;

class ComponentInfoPayment extends Component
{
    public $infoPayment;
    public function __construct($infoPayment)
    {
        $this->infoPayment= $infoPayment;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.component-info-payment');
    }
}
