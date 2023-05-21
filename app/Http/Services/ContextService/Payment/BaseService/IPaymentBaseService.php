<?php

namespace App\Http\Services\ContextService\Payment\BaseService;

use App\Http\Services\ContextService\Payment\BaseService\Models\ResultCreateRequestPaymentModel;
use App\Http\Services\ContextService\Payment\BaseService\Models\ResultVerifyPaymentModel;

interface IPaymentBaseService
{
    function createRequestPayment($serviceName  , $modelOrderPayment , $user ) :ResultCreateRequestPaymentModel|null;

    function verifyRequestPayment($serviceName  , $dataPayment , $user ) :ResultVerifyPaymentModel|null;

}
