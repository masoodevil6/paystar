<?php

namespace App\Http\Services\ContextService\Payment\BaseService;

use App\Http\Services\ContextService\BaseService\BaseService;
use App\Http\Services\ContextService\Payment\BaseService\Models\ResultCreateRequestPaymentModel;
use Illuminate\Support\Facades\Config;

class PaymentUrlBaseService extends PaymentMessageBaseService
{

    /**@var string $urlSubmitRequest*/
    private $urlSubmitRequest="";

    /**@var string $urlStartPaySubmitRequest*/
    private $urlStartPaySubmitRequest="";

    /**@var string $urlVerifySubmitPayment*/
    private $urlVerifySubmitPayment="";

    /**@var string $urlCallbackPayment*/
    private $urlCallbackPayment="";


    protected function setUrlSubmitRequest(string $urlSubmitRequest)
    {
        $this->urlSubmitRequest = $urlSubmitRequest;
    }

    protected function setUrlStartPaySubmitRequest(string $urlStartPaySubmitRequest)
    {
        $this->urlStartPaySubmitRequest = $urlStartPaySubmitRequest;
    }

    protected function setUrlVerifySubmitPayment(string $urlVerifySubmitPayment)
    {
        $this->urlVerifySubmitPayment = $urlVerifySubmitPayment;
    }




    function GetUrlRequest() :string
    {
        return $this->urlSubmitRequest;
    }

    function GetUrlCallBackForRequest($serviceName) :string
    {
        return Config::get("payments.callBackForSubmit")."/".$serviceName;
    }

    function GetUrlStartPayRequest() :string
    {
        return $this->urlStartPaySubmitRequest;
    }

    function GetUrlVerifyPayment() :string
    {
        return $this->urlVerifySubmitPayment;
    }


}
