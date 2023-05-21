<?php

namespace App\Http\Services\ContextService;


use App\Http\Services\ContextService\BaseService\BaseService;
use App\Http\Services\ContextService\Payment\BaseService\IPaymentBaseService;
use App\Http\Services\ContextService\Payment\BaseService\PaymentBaseService;

class ContextServiceRepository{

    /**@var BaseService<IPaymentBaseService> $PaymentService*/
    private static $PaymentService;


    //---------------------

    /**@return BaseService<IPaymentBaseService> */
    public static function PaymentService() : IPaymentBaseService
    {
        if (self::$PaymentService == null){
            self::$PaymentService = new PaymentBaseService();
        }
        return self::$PaymentService;
    }

}
