<?php

namespace App\View\Components;

use Illuminate\View\Component;

class componentItemBasket extends Component
{
    public $itemKey;
    public $itemInfo;
    public $showOption;

    public $showStatusSubmitted;

    public function __construct($itemKey , $itemInfo , $showOption = false , $showStatusSubmitted=false)
    {
        $this-> itemKey = $itemKey;
        $this-> itemInfo = $itemInfo;
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
        return view('components.component_item_basket');
    }
}
