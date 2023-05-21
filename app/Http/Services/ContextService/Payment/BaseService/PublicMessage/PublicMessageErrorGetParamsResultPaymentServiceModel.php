<?php

namespace App\Http\Services\ContextService\Payment\BaseService\PublicMessage;

use App\Http\Services\ContextService\BaseService\Models\PublicMessageModel;

class PublicMessageErrorGetParamsResultPaymentServiceModel extends PublicMessageModel
{
    public static $messageName = "ErrorGetParamsResultPaymentServiceModel";


    public function __construct()
    {
        $this->setTitle(self::$messageName);
        $this->setMessages("پارامترهای دریافتی از درگاه نامعتبر است");
    }


}
