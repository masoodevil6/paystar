<?php

namespace App\Http\Services\ContextService\Payment\BaseService;

use App\Http\Services\ContextService\BaseService\BaseService;
use App\Http\Services\ContextService\Payment\BaseService\Models\ResultCreateRequestPaymentModel;
use App\Http\Services\ContextService\Payment\BaseService\Models\ResultVerifyPaymentModel;
use App\Tools\Models\Repositories\Orders\ModelOrderPayment;

class PaymentBaseService extends BaseService implements IPaymentBaseService
{

    public function __construct()
    {
        parent::__construct("payments.payments");
    }


    public function createRequestPayment($serviceName , $modelOrderPayment , $user ):ResultCreateRequestPaymentModel|null
    {
        $resultCreateRequestPaymentModel = new ResultCreateRequestPaymentModel();

        if (!$serviceName == null && !empty($serviceName)){
            $instanceBankService = $this->getInstanceClassService($serviceName);

            if ($instanceBankService != null){
                $resultCreateRequestPaymentModel = $instanceBankService->createRequestPayment($serviceName , $modelOrderPayment , $user );
            }
            else{
                $resultCreateRequestPaymentModel->setMsg($this->getTextPublicMessage(self::$ErrorNotExistPaymentServiceMode));
            }

        }
        else{
            $resultCreateRequestPaymentModel->setMsg($this->getTextPublicMessage(self::$ErrorNotExistPaymentServiceMode));
        }

        return $resultCreateRequestPaymentModel;
    }



    function verifyRequestPayment($serviceName, $dataPayment, $user): ResultVerifyPaymentModel|null
    {
        $resultVerifyPaymentModel = new ResultVerifyPaymentModel();

        if (!$serviceName == null && !empty($serviceName)){
            $instanceBankService = $this->getInstanceClassService($serviceName);

            if ($instanceBankService != null){
                $resultVerifyPaymentModel = $instanceBankService->verifyRequestPayment($serviceName, $dataPayment, $user);
            }
            else{
                $resultVerifyPaymentModel->setMessage($this->getTextPublicMessage(self::$ErrorNotExistPaymentServiceMode));
            }

        }
        else{
            $resultVerifyPaymentModel->setMessage($this->getTextPublicMessage(self::$ErrorNotExistPaymentServiceMode));
        }

        return $resultVerifyPaymentModel;
    }
}
