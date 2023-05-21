<?php

namespace App\Http\Services\ContextService\Payment\PayStar;


use App\Http\Services\ContextService\Payment\BaseService\IPaymentBaseService;
use App\Http\Services\ContextService\Payment\BaseService\Models\ResultCreateRequestPaymentModel;
use App\Http\Services\ContextService\Payment\BaseService\Models\ResultVerifyPaymentModel;
use App\Http\Services\ContextService\Payment\BaseService\PublicMessage\PublicMessageErrorNoMatchCartNumberPaymentServiceModel;
use App\Http\Services\onTimeService\Keys\KeysService;
use App\Models\Orders\Order;
use App\Models\Users\User;
use App\Repositories\ContextRepository;
use App\Tools\Models\Repositories\Orders\ModelOrderPayment;

class PayStarService extends PayStarTools implements IPaymentBaseService {

    public static $serviceNameEn = "PayStar";
    public static $serviceNameFa = "پی استار";



    /**@param User $user
     * @param ModelOrderPayment $modelOrderPayment
     */
    function createRequestPayment($serviceName , $modelOrderPayment , $user ): ResultCreateRequestPaymentModel|null
    {
        $resultCreateRequestPaymentModel = new ResultCreateRequestPaymentModel();

        $dataToken= $this->GetMerchantIdBankPayment(self::$serviceNameEn);
        if (!empty($dataToken) && $dataToken !=null){

            $urlCallBack = $this->GetUrlCallBackForRequest(self::$serviceNameEn);

            $dataRequest = [
                "amount" => $modelOrderPayment->getPriceForPayment() ,
                "callback" => $urlCallBack ,
                "order_id" =>   $modelOrderPayment->getResNum() ,
                "description" => $modelOrderPayment->getPaymentDescription() ,
                "callback_method" => 1 ,
                "sign" => $this->generateSignCreatePayment($modelOrderPayment->getPriceForPayment() ,  $modelOrderPayment->getResNum()  ,$dataToken["access_token"] )
            ];

            if ($user != null && !empty($user)){
                if(isset($user->email)){
                    $dataRequest["mail"] = $user->email;
                }
                if(isset($user->mobile)){
                    $dataRequest["phone"] = $user->mobile;
                }
                if(isset($user->full_name)){
                    $dataRequest["name"] = $user->name;
                }
                if(isset($user->cart_number)){
                    $dataRequest["card_number"] = $user->cart_number;
                }
            }


            $resultCreateRequestPaymentModel = $this->doCreateRequestPayment($dataRequest , $modelOrderPayment , $user , $dataToken);

        }
        else{
            $resultCreateRequestPaymentModel->setMsg($this->getTextPublicMessage(self::$ErrorInPaymentServiceModel));
        }
        return $resultCreateRequestPaymentModel;
    }



    /**
     * @param User $user
     */
    function verifyRequestPayment($serviceName, $dataPayment, $user): ResultVerifyPaymentModel|null
    {
        $resultVerifyPaymentModel = new ResultVerifyPaymentModel();
        $resultVerifyPaymentModel->setPaymentName(self::$serviceNameFa);

        $dataToken= $this->GetMerchantIdBankPayment(self::$serviceNameEn);

        if (!empty($dataToken) && $dataToken !=null){
            if (isset($dataPayment["order_id"]) && isset($dataPayment["ref_num"])){
                $resNum = $dataPayment["order_id"];
                $refNum = $dataPayment["ref_num"];
                $payment= ContextRepository::BankPaymentRepository()->getPaymentDataResNumAndRefNum($resNum , $refNum);

                if ($payment != null && !empty($payment)){

                    $resultVerifyPaymentModel->setAmount($payment["amount"]);
                    $resultVerifyPaymentModel->setDescription($payment["description"]);
                    $resultVerifyPaymentModel->setResNum($payment["Res_num"]);
                    $resultVerifyPaymentModel->setRefNum($payment["ref_num"]);
                    $resultVerifyPaymentModel->setOrderId($payment["order_id"]);
                    $resultVerifyPaymentModel->setUserId($payment["user_id"]);
                    if (!empty($payment->order) && $payment->order!=null){
                        $resultVerifyPaymentModel->setOrderResNum($payment->order->res_num);
                    }
                    $resultVerifyPaymentModel->setEmail($payment["email"]);
                    $resultVerifyPaymentModel->setPhone($payment["mobile"]);

                    if (isset($dataPayment["status"])) {
                        $status = $dataPayment["status"];
                        $isContinue = $this->isContinueRequest($status);

                        if ($isContinue){
                            if (isset($dataPayment["card_number"])){

                                $clientCartNum = $this->getLastString($user->cart_number , 4);
                                $paymentCartNum = $this->getLastString($dataPayment["card_number"] , 4);

                                if ($clientCartNum == $paymentCartNum) {
                                    $resultVerifyPaymentModel = $this->doVerifyRequestPayment($dataPayment , $payment , $user , $dataToken , $resultVerifyPaymentModel);
                                }
                                else{
                                    $resultVerifyPaymentModel->setMessage($this->getTextPublicMessage(self::$ErrorNoMatchCartNumberPaymentServiceModel));
                                }
                            }
                            else{
                                $resultVerifyPaymentModel->setMessage($this->getTextPublicMessage(self::$ErrorGetParamsResultPaymentServiceModel));
                            }
                        }
                        else{
                            $message = $this->getMessageFaFromCode($status);
                            $resultVerifyPaymentModel->setMessage($message);
                        }
                    }  else{
                        $resultVerifyPaymentModel->setMessage($this->getTextPublicMessage(self::$ErrorGetParamsResultPaymentServiceModel));
                    }

                }
                else{
                    $resultVerifyPaymentModel->setMessage($this->getTextPublicMessage(self::$ErrorNotExistPaymentResNumModel));
                }
            }
            else{
                $resultVerifyPaymentModel->setMessage($this->getTextPublicMessage(self::$ErrorNotExistPaymentResNumModel));
            }
        }
        else{
            $resultVerifyPaymentModel->setMessage($this->getTextPublicMessage(self::$ErrorInPaymentServiceModel));
        }




        return $resultVerifyPaymentModel;
    }





}
