<?php

namespace App\Http\Services\ContextService\Payment\PayStar;

use App\Http\Services\ContextService\Payment\BaseService\PaymentToolsBaseService;

class PayStarUrl extends PaymentToolsBaseService{

    public function __construct()
    {
        parent::__construct();

        $this->setUrlSubmitRequest("https://core.paystar.ir/api/pardakht/create");
        $this->setUrlStartPaySubmitRequest("https://core.paystar.ir/api/pardakht/payment");
        $this->setUrlVerifySubmitPayment("https://core.paystar.ir/api/pardakht/verify");

    }


    protected function getUrlStartPaymentPayStarRequest($token){
        return $this->GetUrlStartPayRequest()."?token=".$token;
    }
}
