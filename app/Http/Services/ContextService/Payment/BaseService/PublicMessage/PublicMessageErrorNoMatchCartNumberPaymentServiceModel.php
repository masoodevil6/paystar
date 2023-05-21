<?php

namespace App\Http\Services\ContextService\Payment\BaseService\PublicMessage;

use App\Http\Services\ContextService\BaseService\Models\PublicMessageModel;

class PublicMessageErrorNoMatchCartNumberPaymentServiceModel extends PublicMessageModel
{
    public static $messageName = "ErrorNoMatchCartNumberPaymentServiceModel";


    public function __construct()
    {
        $this->setTitle(self::$messageName);
        $this->setMessages("شماره کارتی که سفارش با آن پرداخت شده است با شماره کارت پنل شما همخوانی نداشته، مبلغ تا 72 ساعت آینده به حساب شما برگشت داده می شود");
    }


}
