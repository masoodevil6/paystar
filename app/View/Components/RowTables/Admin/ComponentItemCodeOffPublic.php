<?php

namespace App\View\Components\RowTables\Admin;

use Illuminate\View\Component;

class ComponentItemCodeOffPublic extends Component
{
    public $codeOffPublicKey;
    public $codeOffPublicId;
    public $codeOffPublicCode;
    public $codeOffPublicImage;
    public $codeOffPublicMinPrice;
    public $codeOffPublicOffPrice;
    public $codeOffPublicCreatedAt;
    public $codeOffPublicPeriod;
    public $codeOffPublicStatus;
    public function __construct($codeOffPublicKey , $codeOffPublicId , $codeOffPublicCode , $codeOffPublicImage , $codeOffPublicMinPrice , $codeOffPublicOffPrice  , $codeOffPublicCreatedAt , $codeOffPublicPeriod , $codeOffPublicStatus )
    {
        $this -> codeOffPublicKey = $codeOffPublicKey;
        $this -> codeOffPublicId = $codeOffPublicId;
        $this -> codeOffPublicCode = $codeOffPublicCode;
        $this -> codeOffPublicImage = $codeOffPublicImage;
        $this -> codeOffPublicMinPrice = $codeOffPublicMinPrice;
        $this -> codeOffPublicOffPrice = $codeOffPublicOffPrice;
        $this -> codeOffPublicCreatedAt = jalaliDate($codeOffPublicCreatedAt);
        $this -> codeOffPublicPeriod = $codeOffPublicPeriod . " روز";
        $this -> codeOffPublicStatus = $codeOffPublicStatus;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.row-tables.admin.component-item-code-off-public');
    }
}
