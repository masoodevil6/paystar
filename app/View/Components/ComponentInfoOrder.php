<?php

namespace App\View\Components;

use App\Tools\Models\Repositories\Banks\ModelVerifyBankPayment;
use Illuminate\View\Component;

class ComponentInfoOrder extends Component
{
    public $orderResNum;
    public $listBasket;
    public $infoPrice;
    public $codeOff;
    public $codeOffPrice;
    public $codeOffPricePass;
    public $existSuccessPayment;
    public $infoPayment;
    public $payments;

    public $showStatusSubmitted;

    /**
     * @param  ModelVerifyBankPayment $orderInfo
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($orderInfo , $showStatusSubmitted=false)
    {
        $this->orderResNum= $orderInfo->getOrderResNum();
        $this->listBasket = $orderInfo->getListBasket()->getCollect();
        $this->infoPrice = $orderInfo->getInfoPrice();
        $this->codeOff = $orderInfo->getCodeOff();
        $this->codeOffPrice = $orderInfo->getCodeOffPrice();
        $this->codeOffPricePass = $orderInfo->getCodeOffPriceTextPass();
        $this->existSuccessPayment = $orderInfo->isExistSuccessPayment();
        $this->infoPayment = $orderInfo->getInfoPayment();
        $this->payments = $orderInfo->getListPayment()->getCollect();

        $this-> showStatusSubmitted = $showStatusSubmitted;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.component-info-order');
    }
}
