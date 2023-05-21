<?php
namespace App\Http\Services\ContextService\Payment\PayStar\Codes;

use App\Http\Services\ContextService\Payment\BaseService\Models\CodeBankModel;

class PayStarCodeNegative99 extends CodeBankModel {

    public function __construct()
    {
        $this->setCode(-98);
        $this->setMessagesEn("error");
        $this->setMessagesFa("خطای سامانه");
        $this->setPublic(true);
        $this->setContinue(false);
    }
}
