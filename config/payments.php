<?php


use App\Http\Services\ContextService\Payment\BaseService\Models\ServiceInfoModel;
use App\Http\Services\ContextService\Payment\PayStar\PayStarService;

$payStarInfo = new ServiceInfoModel();
$payStarInfo->setName(PayStarService::$serviceNameEn);
$payStarInfo->setNameFa(PayStarService::$serviceNameFa);
$payStarInfo->setClass(PayStarService::class);

return [

    "payments" => [
        $payStarInfo ,
    ],


    //"callBackForTest" => "admin.banks.bank.test-result" ,
    "callBackForSubmit" => "http://127.0.0.1:8000/order/result" ,
    //"callBackForSubmitApi" => "order.result.api" ,

];
