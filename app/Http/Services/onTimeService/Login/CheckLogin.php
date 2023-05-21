<?php
namespace App\Http\Services\onTimeService\Login;


use App\Http\Services\onTimeService\Time\TimeService;
use App\Repositories\ContextRepository;
use App\Repositories\ModelRepositories\Users\OtpRepository;

class CheckLogin extends BaseLoginService{

    public function checkLastLogin($token){
        $resultExp = [
            "inputLogin" => null ,
            "isValid" => false ,
            "status" => false ,
            "otp" => null ,
            "title" => "" ,
            "msg" => "" ,
        ];


        $opt = $this->otpRepository->checkLastLogin($token);
        if (!empty($opt)){
            $resultExp["status"] = true;
            $resultExp["otp"] = $opt;
        }


        else{
            $error = $this->getErrorInValidInputRequest();
            $resultExp["title"] = $error["title"];
            $resultExp["msg"] = $error["msg"];
        }
        return $resultExp;
    }


}
