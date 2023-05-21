<?php

namespace App\View\Components\RowTables\Admin;

use Illuminate\View\Component;

class ComponentItemCodeOffPerson extends Component
{
    public $codeOffPersonKey;
    public $codeOffPersonId;
    public $codeOffPersonCode;
    public $codeOffPersonUser;
    public $codeOffPersonMinPrice;
    public $codeOffPersonOffPrice;
    public $codeOffPersonCreatedAt;
    public $codeOffPersonPeriod;
    public $codeOffPersonStatus;
    public function __construct($codeOffPersonKey ,$codeOffPersonId ,$codeOffPersonCode ,$codeOffPersonUser ,$codeOffPersonMinPrice ,$codeOffPersonOffPrice , $codeOffPersonCreatedAt ,$codeOffPersonPeriod ,$codeOffPersonStatus )
    {
        $this -> codeOffPersonKey = $codeOffPersonKey;
        $this -> codeOffPersonId = $codeOffPersonId;
        $this -> codeOffPersonCode = $codeOffPersonCode;
        $this -> codeOffPersonUser = $codeOffPersonUser;
        $this -> codeOffPersonMinPrice = $codeOffPersonMinPrice;
        $this -> codeOffPersonOffPrice = $codeOffPersonOffPrice;
        $this -> codeOffPersonCreatedAt = jalaliDate($codeOffPersonCreatedAt);
        $this -> codeOffPersonPeriod = $codeOffPersonPeriod . " روز";
        $this -> codeOffPersonStatus = $codeOffPersonStatus;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.row-tables.admin.component-item-code-off-person');
    }
}
