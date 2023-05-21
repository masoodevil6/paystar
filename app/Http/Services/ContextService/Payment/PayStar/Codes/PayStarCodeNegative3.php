<?php
namespace App\Http\Services\ContextService\Payment\PayStar\Codes;

use App\Http\Services\ContextService\Payment\BaseService\Models\CodeBankModel;

class PayStarCodeNegative3 extends CodeBankModel {

    public function __construct()
    {
        $this->setCode(-3);
        $this->setMessagesEn("retryToken");
        $this->setMessagesFa("توکن تکراری است");
        $this->setPublic(true);
        $this->setContinue(false);
    }
}
