<?php

namespace App\View\Components\RowTables\Admin;

use Illuminate\View\Component;

class ComponentItemBankPaymentAdmin extends Component
{

    public $bankPaymentKey;
    public $bankPaymentAuthority;
    public $bankPaymentResNum;
    public $bankPaymentRefNum;
    public $bankPaymentBankName;
    public $bankPaymentUserFullName;
    public $bankPaymentIsTest;
    public $bankPaymentIsStatus;
    public $bankPaymentOrderId;
    public $bankPaymentOrderResNum;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($bankPaymentKey , $bankPaymentAuthority , $bankPaymentResNum , $bankPaymentRefNum , $bankPaymentBankName , $bankPaymentUserFullName , $bankPaymentIsTest , $bankPaymentIsStatus , $bankPaymentOrderId , $bankPaymentOrderResNum)
    {
        $this -> bankPaymentKey = $bankPaymentKey;
        $this -> bankPaymentAuthority = $bankPaymentAuthority;
        $this -> bankPaymentResNum = $bankPaymentResNum;
        $this -> bankPaymentRefNum = $bankPaymentRefNum;
        $this -> bankPaymentBankName = $bankPaymentBankName;
        $this -> bankPaymentOrderId = $bankPaymentOrderId;

        if (!empty($bankPaymentOrderResNum)){
            $this -> bankPaymentOrderResNum = $bankPaymentOrderResNum -> res_num;
        }

        if ($bankPaymentIsTest == 0){
            $this -> bankPaymentIsTest = "فروش";
        }
        else{
            $this -> bankPaymentIsTest = "تست";
        }

        if ($bankPaymentIsStatus == 0){
            $this -> bankPaymentIsStatus = " ناتمام";
        }
        else{
            $this -> bankPaymentIsStatus = "پایان";
        }

        if (!empty($bankPaymentUserFullName)){
            $this -> bankPaymentUserFullName = $bankPaymentUserFullName -> fullName;
        }
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.row-tables.admin.component-item-bank-payment-admin');
    }
}
