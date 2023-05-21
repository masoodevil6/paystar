<?php

namespace App\Http\Services\ContextService\Payment\BaseService;

use App\Http\Services\ContextService\BaseService\BaseService;
use App\Http\Services\ContextService\Payment\BaseService\Models\ResultCreateRequestPaymentModel;
use App\Repositories\ContextRepository;

class PaymentToolsBaseService extends PaymentUrlBaseService
{

    protected function GetMerchantIdBankPayment($serviceName){
        $bankInfo= ContextRepository::BankRepository()->GetMerchantIdFromServiceName($serviceName);
        if (!empty($bankInfo) && $bankInfo != null) {
            return [
                "merchant_id" => $bankInfo["merchant_id"] ,
                "access_token" => $bankInfo["access_token"] ,
            ];
        }
        return null;
    }

    /*protected function GetMerchantIdAndAccessTokenBankPayment() : ModelGetDataRefundRequest{
        $modelGetDataRefundRequest = new ModelGetDataRefundRequest();
        $bankInfo= ContextRepository::BankRepository()->GetMerchantIdAndAccessTokenFromClassName($this->getNameSpaceClass());
        if (!empty($bankInfo) && $bankInfo != null) {
            $modelGetDataRefundRequest->setMerchantId($bankInfo["merchant_id"]);
            $modelGetDataRefundRequest->setAccessToken($bankInfo["access_token"]);
        }
        return $modelGetDataRefundRequest;
    }*/


    protected function setSuspensionPaymentFromAuthorityNum($authorityNum , $thisClient=true) :string
    {
        $message = "به علت وجود خطا، تراکنش لغو گشت. برای بررسی بیشتر این موضوع با پشتیبانی در ارتباط باشید. با تشکر از شکیبایی شما";
        ContextRepository::BankPaymentRepository()->setSuspensionPaymentFromAuthorityNum($authorityNum  , $message , $thisClient);
        return $message;
    }

}
