<?php

namespace App\Http\Services\ContextService\Payment\BaseService;

use App\Http\Services\ContextService\BaseService\PublicToolsMessageService;
use App\Http\Services\ContextService\Payment\BaseService\Models\CodeBankModel;
use App\Http\Services\ContextService\Payment\BaseService\PublicMessage\PublicMessageErrorGetParamsResultPaymentServiceModel;
use App\Http\Services\ContextService\Payment\BaseService\PublicMessage\PublicMessageErrorInPaymentServiceModel;
use App\Http\Services\ContextService\Payment\BaseService\PublicMessage\PublicMessageErrorNoMatchCartNumberPaymentServiceModel;
use App\Http\Services\ContextService\Payment\BaseService\PublicMessage\PublicMessageErrorNotExistPaymentResNumModel;
use App\Http\Services\ContextService\Payment\BaseService\PublicMessage\PublicMessageErrorNotExistPaymentServiceModel;

class PaymentMessageBaseService extends PublicToolsMessageService
{
    private $publicError= "به علت وجود خطا، تراکنش لغو گشت. لطفا دوباره تلاش نمایید ...";
    //---------------------
    protected $listCodeMessages = [];


    //---------------------
    public static $ErrorNotExistPaymentServiceMode;
    public static $ErrorInPaymentServiceModel;
    public static $ErrorNotExistPaymentResNumModel;
    public static $ErrorGetParamsResultPaymentServiceModel;
    public static $ErrorNoMatchCartNumberPaymentServiceModel;

    public function __construct()
    {
        //error: service not exist
        self::$ErrorNotExistPaymentServiceMode= PublicMessageErrorNotExistPaymentServiceModel::$messageName;
        array_push($this->listPublicMessages , new PublicMessageErrorNotExistPaymentServiceModel());

        //error: service not exist
        self::$ErrorInPaymentServiceModel= PublicMessageErrorInPaymentServiceModel::$messageName;
        array_push($this->listPublicMessages , new PublicMessageErrorInPaymentServiceModel());

        //error: service not exist
        self::$ErrorNotExistPaymentResNumModel= PublicMessageErrorNotExistPaymentResNumModel::$messageName;
        array_push($this->listPublicMessages , new PublicMessageErrorNotExistPaymentResNumModel());

        //error: service not exist
        self::$ErrorGetParamsResultPaymentServiceModel= PublicMessageErrorGetParamsResultPaymentServiceModel::$messageName;
        array_push($this->listPublicMessages , new PublicMessageErrorGetParamsResultPaymentServiceModel());

        //error: service not exist
        self::$ErrorNoMatchCartNumberPaymentServiceModel= PublicMessageErrorNoMatchCartNumberPaymentServiceModel::$messageName;
        array_push($this->listPublicMessages , new PublicMessageErrorNoMatchCartNumberPaymentServiceModel());
    }





    //---------------------
    function getMessageFromCode($code) :CodeBankModel|null
    {
        foreach ($this->listCodeMessages as $message){
            if ($code == $message->getCode()){
                return $message;
            }
        }
        return null;
    }

    /**@param  CodeBankModel $code*/
    function getMessageFaFromCode($code) :string {
        $message = $this->getMessageFromCode($code);
        if ($message != null && $message->isPublic()){
            return $message->getMessagesFa();
        }
        return $this->publicError;
    }

    /**@param  CodeBankModel $code*/
    function isContinueRequest($code) :bool{
        $message = $this->getMessageFromCode($code);
        if ($message != null){
            return $message->isContinue();
        }
        return false;
    }


}
