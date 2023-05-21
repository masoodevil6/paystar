<?php

namespace App\Http\Services\ContextService\Payment\BaseService\PublicMessage;

use App\Http\Services\ContextService\BaseService\Models\PublicMessageModel;

class PublicMessageErrorNotExistPaymentServiceModel extends PublicMessageModel
{
    public static $messageName = "ErrorNotExistPaymentServiceModel";


    public function __construct()
    {
        $this->setTitle(self::$messageName);
        $this->setMessages("پرداخت مورد نظر یافت نشد");
    }


}
