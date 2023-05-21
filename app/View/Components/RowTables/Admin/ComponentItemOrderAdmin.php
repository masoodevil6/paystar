<?php

namespace App\View\Components\RowTables\Admin;

use Illuminate\View\Component;

class ComponentItemOrderAdmin extends Component
{

    public $orderKey;
    public $orderId;
    public $orderResNum;
    public $orderIsFinish;
    public $orderDescriptionFinish;
    public $orderUserName = "";
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($orderKey , $orderId , $orderResNum , $orderIsFinish , $orderDescriptionFinish , $orderUser)
    {
        $this -> orderKey = $orderKey;
        $this -> orderId = $orderId;
        $this -> orderResNum = $orderResNum;
        $this -> orderIsFinish = $orderIsFinish;
        $this -> orderDescriptionFinish = $orderDescriptionFinish;
        if (!empty($orderUser)){
            $this -> factorUserName = $orderUser -> fullName;
        }
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.row-tables.admin.component-item-order-admin');
    }
}
