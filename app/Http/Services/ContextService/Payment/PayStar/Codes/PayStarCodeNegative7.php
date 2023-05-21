<?php
namespace App\Http\Services\ContextService\Payment\PayStar\Codes;

use App\Http\Services\ContextService\Payment\BaseService\Models\CodeBankModel;

class PayStarCodeNegative7 extends CodeBankModel {

    public function __construct()
    {
        $this->setCode(-7);
        $this->setMessagesEn("badData");
        $this->setMessagesFa("پارامترهای ارسال شده نامعتبر است");
        $this->setPublic(false);
        $this->setContinue(false);
    }
}
