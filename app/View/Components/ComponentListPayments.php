<?php

namespace App\View\Components;

use Illuminate\View\Component;

class ComponentListPayments extends Component
{
    public $payments;
    public function __construct($payments)
    {
        $this->payments= $payments;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.component-list-payments');
    }
}
