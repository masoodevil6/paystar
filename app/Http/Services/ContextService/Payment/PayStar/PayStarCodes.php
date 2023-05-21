<?php

namespace App\Http\Services\ContextService\Payment\PayStar;

use App\Http\Services\ContextService\Payment\BaseService\PaymentMessageBaseService;
use App\Http\Services\ContextService\Payment\PayStar\Codes\PayStarCodeNegative1;
use App\Http\Services\ContextService\Payment\PayStar\Codes\PayStarCodeNegative2;
use App\Http\Services\ContextService\Payment\PayStar\Codes\PayStarCodeNegative3;
use App\Http\Services\ContextService\Payment\PayStar\Codes\PayStarCodeNegative4;
use App\Http\Services\ContextService\Payment\PayStar\Codes\PayStarCodeNegative5;
use App\Http\Services\ContextService\Payment\PayStar\Codes\PayStarCodeNegative6;
use App\Http\Services\ContextService\Payment\PayStar\Codes\PayStarCodeNegative7;
use App\Http\Services\ContextService\Payment\PayStar\Codes\PayStarCodeNegative8;
use App\Http\Services\ContextService\Payment\PayStar\Codes\PayStarCodeNegative9;
use App\Http\Services\ContextService\Payment\PayStar\Codes\PayStarCodeNegative98;
use App\Http\Services\ContextService\Payment\PayStar\Codes\PayStarCodeNegative99;
use App\Http\Services\ContextService\Payment\PayStar\Codes\PayStarCodePositive1;

class PayStarCodes extends PayStarUrl{

    public function __construct()
    {
        parent::__construct();

        array_push($this->listCodeMessages , new PayStarCodePositive1());
        array_push($this->listCodeMessages , new PayStarCodeNegative2());
        array_push($this->listCodeMessages , new PayStarCodeNegative3());
        array_push($this->listCodeMessages , new PayStarCodeNegative4());
        array_push($this->listCodeMessages , new PayStarCodeNegative5());
        array_push($this->listCodeMessages , new PayStarCodeNegative6());
        array_push($this->listCodeMessages , new PayStarCodeNegative7());
        array_push($this->listCodeMessages , new PayStarCodeNegative8());
        array_push($this->listCodeMessages , new PayStarCodeNegative9());
        array_push($this->listCodeMessages , new PayStarCodeNegative98());
        array_push($this->listCodeMessages , new PayStarCodeNegative99());
    }
}
