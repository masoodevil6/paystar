<?php

namespace App\View\Components;

use Illuminate\View\Component;

class componentTableBasket extends Component
{
    public $listBasket;
    public $showOption = false;
    public $showStatusSubmitted = false;

    public function __construct($listBasket = [] , $showOption = false , $showStatusSubmitted=false)
    {
        $this-> listBasket = $listBasket;
        $this-> showOption = $showOption;
        $this-> showStatusSubmitted = $showStatusSubmitted;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.component_table_basket');
    }
}
