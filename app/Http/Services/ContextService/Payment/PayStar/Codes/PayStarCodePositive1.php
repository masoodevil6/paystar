<?php
namespace App\Http\Services\ContextService\Payment\PayStar\Codes;

use App\Http\Services\ContextService\Payment\BaseService\Models\CodeBankModel;

class PayStarCodePositive1 extends CodeBankModel {

    public function __construct()
    {
        $this->setCode(1);
        $this->setMessagesEn("Ok");
        $this->setMessagesFa("موفق");
        $this->setPublic(true);
        $this->setContinue(true);
    }
}
