<?php
namespace App\Http\Services\ContextService\Payment\PayStar\Codes;

use App\Http\Services\ContextService\Payment\BaseService\Models\CodeBankModel;

class PayStarCodeNegative5 extends CodeBankModel {

    public function __construct()
    {
        $this->setCode(-5);
        $this->setMessagesEn("invalidRefNum");
        $this->setMessagesFa("شناسه ref_num معتبر نیست");
        $this->setPublic(false);
        $this->setContinue(false);
    }
}
