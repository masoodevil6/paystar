<?php

namespace App\Http\Services\ContextService\Payment\PayStar;


use App\Http\Services\ContextService\Payment\BaseService\IPaymentBaseService;
use App\Http\Services\ContextService\Payment\BaseService\Models\ResultCreateRequestPaymentModel;
use App\Http\Services\ContextService\Payment\BaseService\Models\ResultVerifyPaymentModel;
use App\Http\Services\onTimeService\Keys\KeysService;
use App\Models\Banks\BankPayment;
use App\Models\Orders\Order;
use App\Models\Users\User;
use App\Repositories\ContextRepository;
use App\Tools\Models\Repositories\Orders\ModelOrderPayment;
use Illuminate\Support\Facades\Http;
use PhpParser\Node\Scalar\String_;

class PayStarTools extends PayStarCodes{

    /**
     * @param array $dataRequest
     * @param User $user
     * @param ModelOrderPayment $modelOrderPayment
     * @param array $merchantId
     */
    function doCreateRequestPayment($dataRequest , $modelOrderPayment , $user , $dataToken): ResultCreateRequestPaymentModel
    {
        $resultCreateRequestPaymentModel = new ResultCreateRequestPaymentModel();
        $urlRequest = $this->GetUrlRequest();

        $response = Http::withHeaders(["Content-Type" => "application/json"])
            ->withToken($dataToken["merchant_id"])
            ->post($urlRequest, $dataRequest);
        if ($response->status() == 200) {
            $result = $response->json();
            $status = $result["status"];

            $message = $this->getMessageFaFromCode($status);
            $resultCreateRequestPaymentModel->setMsg($message);

            $isContinue = $this->isContinueRequest($status);

            if ($isContinue){
                $resultCreateRequestPaymentModel->setStatus(true);

                $serviceName = PayStarService::$serviceNameFa;
                $orderId = $modelOrderPayment->getOrderId();
                $userId = $user->id;

                $amount = 0;
                if (isset($dataRequest["amount"])){
                    $amount = $dataRequest["amount"];
                }

                $description = "";
                if (isset($dataRequest["description"])){
                    $description = $dataRequest["description"];
                }

                $mail = "";
                if (isset($dataRequest["mail"])){
                    $mail = $dataRequest["mail"];
                }

                $phone = "";
                if (isset($dataRequest["phone"])){
                    $phone = $dataRequest["phone"];
                }

                $token = "";
                $refNum = "";
                $resNum = "";
                if (isset($result["data"]) ){
                    $data = $result["data"];

                    if (isset($data["token"])){
                        $token = $data["token"];
                    }
                    if (isset($data["ref_num"])){
                        $refNum = $data["ref_num"];
                    }
                    if (isset($data["order_id"])){
                        $resNum = $data["order_id"];
                    }
                }

                ContextRepository::BankPaymentRepository()->addSubmitRequestWithRefNum(
                    $serviceName,
                    false ,
                    $orderId ,
                    $userId ,
                    $resNum ,
                    $refNum ,
                    $token ,
                    $amount ,
                    $description,
                    $phone,
                    $mail
                );

                $resultCreateRequestPaymentModel->setRedirect($this->getUrlStartPaymentPayStarRequest($token));
            }
        }
        else{
            $resultCreateRequestPaymentModel->setMsg($this->getTextPublicMessage(self::$ErrorInPaymentServiceModel));
        }

        return $resultCreateRequestPaymentModel;
    }

    /**
     * @param array $dataPayment
     * @param BankPayment $payment
     * @param User $user
     * @param array $dataToken
     * @param ResultVerifyPaymentModel $resultVerifyPaymentModel
     */
    function doVerifyRequestPayment($dataPayment , $payment , $user ,$dataToken , $resultVerifyPaymentModel): ResultVerifyPaymentModel|null
    {

        if (isset($dataPayment["card_number"]) && isset($dataPayment["tracking_code"])) {

            $urlRequest = $this->GetUrlVerifyPayment();

            $dataRequest = [
                "ref_num" => $payment->ref_num ,
                "amount" => $payment->amount ,
                "sign" => $this->generateSignVerifyPayment($payment->amount ,  $payment->ref_num , $dataPayment["card_number"] ,$dataPayment["tracking_code"]   ,$dataToken["access_token"] )
            ];

            $response = Http::withHeaders(["Content-Type" => "application/json"])
                ->withToken($dataToken["merchant_id"])
                ->post($urlRequest, $dataRequest);

            if ($response->status() == 200) {
                $result = $response->json();
                $status = $result["status"];
                $resultVerifyPaymentModel->setCode($status);

                $message = $this->getMessageFaFromCode($status);
                $resultVerifyPaymentModel->setMessage($message);

                $isContinue = $this->isContinueRequest($status);

                $token = $payment->authority_num;
                if ($isContinue){

                    $refNum = $resultVerifyPaymentModel->getRefNum();
                    $extraData = [];
                    if (isset($dataPayment["transaction_id"])){
                        $extraData["transaction_id"] =  $dataPayment["transaction_id"];
                    }
                    if (isset($dataPayment["card_number"])){
                        $extraData["card_number"] =  $dataPayment["card_number"];
                    }
                    if (isset($dataPayment["tracking_code"])){
                        $extraData["tracking_code"] =  $dataPayment["tracking_code"];
                    }

                    ContextRepository::BankPaymentRepository()->setVerifyDataPayment($status , $message , $refNum , $extraData , $token , true);

                    $resultVerifyPaymentModel->setStatusPayment(true);
                }
                else{
                    ContextRepository::BankPaymentRepository()->setFailedPaymentFromAuthorityNum($token , $status , $message , true);
                }
            }
            else{
                $resultVerifyPaymentModel->setMessage($this->getTextPublicMessage(self::$ErrorInPaymentServiceModel));
            }
        }
        else{
            $resultVerifyPaymentModel->setMessage($this->getTextPublicMessage(self::$ErrorGetParamsResultPaymentServiceModel));
        }



        return $resultVerifyPaymentModel;
    }




    protected function generateSignCreatePayment($amount , $resNum , $accessToken){
        $urlCallBack = $this->GetUrlCallBackForRequest(PayStarService::$serviceNameEn);
        return (new KeysService())->generateHmacSha512($amount."#".$resNum."#".$urlCallBack, $accessToken);
    }

    protected function generateSignVerifyPayment($amount , $refNum ,$cardNumber , $trackingCode , $accessToken){
        return (new KeysService())->generateHmacSha512($amount."#".$refNum."#".$cardNumber."#".$trackingCode, $accessToken);
    }

    protected function getLastString($text , $length){
        $textExp = "";
        $text = strrev($text);
        for ($i=0 ; $i <$length ; $i++){
            $textExp .= $text[$i];
        }
        $textExp = strrev($textExp);
        return $textExp;
    }
}
