<?php
namespace App\Http\Services\ContextService\Payment\PayStar\Codes;

use App\Http\Services\ContextService\Payment\BaseService\Models\CodeBankModel;

class PayStarCodeNegative98 extends CodeBankModel {

    public function __construct()
    {
        $this->setCode(-98);
        $this->setMessagesEn("paymentFailed");
        $this->setMessagesFa("تراکنش ناموفق");
        $this->setPublic(true);
        $this->setContinue(false);
    }
}
