<?php
namespace App\Http\Services\ContextService\Payment\PayStar\Codes;

use App\Http\Services\ContextService\Payment\BaseService\Models\CodeBankModel;

class PayStarCodeNegative9 extends CodeBankModel {

    public function __construct()
    {
        $this->setCode(-9);
        $this->setMessagesEn("trNotVerified");
        $this->setMessagesFa("تراکنش وریفای نشد");
        $this->setPublic(false);
        $this->setContinue(false);
    }
}
