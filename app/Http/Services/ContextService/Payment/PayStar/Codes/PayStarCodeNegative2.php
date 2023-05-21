<?php
namespace App\Http\Services\ContextService\Payment\PayStar\Codes;

use App\Http\Services\ContextService\Payment\BaseService\Models\CodeBankModel;

class PayStarCodeNegative2 extends CodeBankModel {

    public function __construct()
    {
        $this->setCode(-1);
        $this->setMessagesEn("inactiveGateway");
        $this->setMessagesFa("درگاه فعال نیست");
        $this->setPublic(true);
        $this->setContinue(false);
    }
}
