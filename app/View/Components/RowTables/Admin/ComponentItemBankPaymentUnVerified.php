<?php

namespace App\View\Components\RowTables\Admin;

use Illuminate\View\Component;

class ComponentItemBankPaymentUnVerified extends Component
{
    public $bankPaymentUnVerifiedKey;
    public $bankPaymentUnVerifiedId;
    public $bankPaymentUnVerifiedAuthority;
    public $bankPaymentUnVerifiedBankName;
    public $bankPaymentUnVerifiedUserFullName;
    public $bankPaymentUnVerifiedStatus;
    public $bankPaymentUnVerifiedOrderId;
    public $bankPaymentUnVerifiedOrderResNum;
    public $bankPaymentUnVerifiedOrderBankPaymentId;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($bankPaymentUnVerifiedKey ,$bankPaymentUnVerifiedId , $bankPaymentUnVerifiedAuthority , $bankPaymentUnVerifiedBankName , $bankPaymentUnVerifiedUserFullName , $bankPaymentUnVerifiedStatus , $bankPaymentUnVerifiedOrderResNum , $bankPaymentUnVerifiedOrderId=null , $bankPaymentUnVerifiedOrderBankPaymentId=null )
    {
        $this -> bankPaymentUnVerifiedKey = $bankPaymentUnVerifiedKey;
        $this -> bankPaymentUnVerifiedId = $bankPaymentUnVerifiedId;
        $this -> bankPaymentUnVerifiedAuthority = $bankPaymentUnVerifiedAuthority;
        $this -> bankPaymentUnVerifiedBankName = $bankPaymentUnVerifiedBankName;
        $this -> bankPaymentUnVerifiedOrderId = $bankPaymentUnVerifiedOrderId;
        $this -> bankPaymentUnVerifiedOrderBankPaymentId = $bankPaymentUnVerifiedOrderBankPaymentId;

        if (!empty($bankPaymentUnVerifiedOrderResNum)){
            $this -> bankPaymentUnVerifiedOrderResNum = $bankPaymentUnVerifiedOrderResNum -> res_num;
        }

        if ($bankPaymentUnVerifiedStatus == 0){
            $this -> bankPaymentUnVerifiedStatus = " ناتمام";
        }
        else{
            $this -> bankPaymentUnVerifiedStatus = "پایان";
        }

        if (!empty($bankPaymentUnVerifiedUserFullName)){
            $this -> bankPaymentUnVerifiedUserFullName = $bankPaymentUnVerifiedUserFullName -> fullName;
        }
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.row-tables.admin.component-item-bank-payment-un-verified');
    }
}
