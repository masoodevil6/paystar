<?php
namespace App\Http\Services\ContextService\Payment\PayStar\Codes;

use App\Http\Services\ContextService\Payment\BaseService\Models\CodeBankModel;

class PayStarCodeNegative4 extends CodeBankModel {

    public function __construct()
    {
        $this->setCode(-4);
        $this->setMessagesEn("amountLimitExceed");
        $this->setMessagesFa("مبلغ بیشتر از سقف مجاز درگاه است");
        $this->setPublic(false);
        $this->setContinue(false);
    }
}
