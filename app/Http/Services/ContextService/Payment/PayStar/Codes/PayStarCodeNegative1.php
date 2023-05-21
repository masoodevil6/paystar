<?php
namespace App\Http\Services\ContextService\Payment\PayStar\Codes;

use App\Http\Services\ContextService\Payment\BaseService\Models\CodeBankModel;

class PayStarCodeNegative1 extends CodeBankModel {

    public function __construct()
    {
        $this->setCode(-1);
        $this->setMessagesEn("invalidRequest");
        $this->setMessagesFa("درخواست نامعتبر (خطا در پارامترهای ورودی)");
        $this->setPublic(true);
        $this->setContinue(false);
    }
}
