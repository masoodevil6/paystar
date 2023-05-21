<?php
namespace App\Http\Services\ContextService\Payment\PayStar\Codes;

use App\Http\Services\ContextService\Payment\BaseService\Models\CodeBankModel;

class PayStarCodeNegative8 extends CodeBankModel {

    public function __construct()
    {
        $this->setCode(-8);
        $this->setMessagesEn("trNotVerifiable");
        $this->setMessagesFa("تراکنش را نمیتوان وریفای کرد");
        $this->setPublic(false);
        $this->setContinue(false);
    }
}
