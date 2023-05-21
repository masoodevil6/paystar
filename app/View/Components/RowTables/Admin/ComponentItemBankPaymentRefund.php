<?php

namespace App\View\Components\RowTables\Admin;

use Illuminate\View\Component;

class ComponentItemBankPaymentRefund extends Component
{

    public $bankPaymentRefundKey;
    public $bankPaymentRefundId;
    public $bankPaymentRefundResNum;
    public $bankPaymentRefundRefNum;
    public $bankPaymentRefundAuthority;
    public $bankPaymentRefundBankName;
    public $bankPaymentRefundUserFullName;
    public $bankPaymentRefundStatus;
    public $bankPaymentRefundOrderId;
    public $bankPaymentRefundOrderResNum;
    public $bankPaymentRefundOrderBankPaymentId;


    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($bankPaymentRefundKey ,$bankPaymentRefundId , $bankPaymentRefundResNum, $bankPaymentRefundRefNum, $bankPaymentRefundAuthority , $bankPaymentRefundBankName , $bankPaymentRefundUserFullName , $bankPaymentRefundStatus  , $bankPaymentRefundOrderResNum, $bankPaymentRefundOrderId=null , $bankPaymentRefundOrderBankPaymentId=null)
    {
        $this -> bankPaymentRefundKey = $bankPaymentRefundKey;
        $this -> bankPaymentRefundId = $bankPaymentRefundId;
        $this -> bankPaymentRefundResNum = $bankPaymentRefundResNum;
        $this -> bankPaymentRefundRefNum = $bankPaymentRefundRefNum;
        $this -> bankPaymentRefundAuthority = $bankPaymentRefundAuthority;
        $this -> bankPaymentRefundBankName = $bankPaymentRefundBankName;
        $this -> bankPaymentRefundOrderId = $bankPaymentRefundOrderId;
        $this -> bankPaymentRefundOrderBankPaymentId = $bankPaymentRefundOrderBankPaymentId;

        if (!empty($bankPaymentRefundOrderResNum)){
            $this -> bankPaymentRefundOrderResNum = $bankPaymentRefundOrderResNum -> res_num;
        }

        if ($bankPaymentRefundStatus == 0){
            $this -> bankPaymentRefundStatus = " ناموفق";
        }
        else{
            $this -> bankPaymentRefundStatus = "موفق";
        }

        if (!empty($bankPaymentRefundUserFullName)){
            $this -> bankPaymentRefundUserFullName = $bankPaymentRefundUserFullName -> fullName;
        }
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.row-tables.admin.component-item-bank-payment-refund');
    }
}
