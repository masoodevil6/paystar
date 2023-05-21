<?php
namespace App\Http\Services\ContextService\Payment\PayStar\Codes;

use App\Http\Services\ContextService\Payment\BaseService\Models\CodeBankModel;

class PayStarCodeNegative6 extends CodeBankModel {

    public function __construct()
    {
        $this->setCode(-6);
        $this->setMessagesEn("retryVerification");
        $this->setMessagesFa("تراکنش قبلا وریفای شده است");
        $this->setPublic(true);
        $this->setContinue(false);
    }
}
