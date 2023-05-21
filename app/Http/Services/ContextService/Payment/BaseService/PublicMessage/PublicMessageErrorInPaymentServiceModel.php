<?php

namespace App\Http\Services\ContextService\Payment\BaseService\PublicMessage;

use App\Http\Services\ContextService\BaseService\Models\PublicMessageModel;

class PublicMessageErrorInPaymentServiceModel extends PublicMessageModel
{
    public static $messageName = "ErrorInPaymentServiceModel";


    public function __construct()
    {
        $this->setTitle(self::$messageName);
        $this->setMessages("به علت وجود خطا، تراکنش لغو گشت. لطفا دوباره تلاش نمایید ...");
    }


}
