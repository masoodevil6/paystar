<?php

namespace App\Http\Services\ContextService\Payment\BaseService\PublicMessage;

use App\Http\Services\ContextService\BaseService\Models\PublicMessageModel;

class PublicMessageErrorNotExistPaymentResNumModel extends PublicMessageModel
{
    public static $messageName = "ErrorNotExistPaymentResNumModel";


    public function __construct()
    {
        $this->setTitle(self::$messageName);
        $this->setMessages("شناسه پرداخت مورد نظر یافت نشد");
    }


}
