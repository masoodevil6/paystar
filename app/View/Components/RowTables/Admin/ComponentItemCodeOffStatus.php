<?php

namespace App\View\Components\RowTables\Admin;

use Illuminate\View\Component;

class ComponentItemCodeOffStatus extends Component
{
    public $codeOffStatusKey;
    public $codeOffStatusId;
    public $codeOffStatusMinPrice;
    public $codeOffStatusOffPrice;
    public $codeOffStatusPeriod;
    public $codeOffStatusStatus;
    public function __construct($codeOffStatusKey , $codeOffStatusId ,$codeOffStatusMinPrice,$codeOffStatusOffPrice,$codeOffStatusPeriod,$codeOffStatusStatus)
    {
        $this -> codeOffStatusKey = $codeOffStatusKey;
        $this -> codeOffStatusId = $codeOffStatusId;
        $this -> codeOffStatusMinPrice = $codeOffStatusMinPrice;
        $this -> codeOffStatusOffPrice = $codeOffStatusOffPrice;
        $this -> codeOffStatusPeriod = $codeOffStatusPeriod . " روز";
        $this -> codeOffStatusStatus = $codeOffStatusStatus;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.row-tables.admin.component-item-code-off-status');
    }
}
