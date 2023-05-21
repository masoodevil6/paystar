<?php

namespace App\Http\Services\onTimeService\Login;

use App\Http\Services\onTimeService\Messages\Email\Emails;
use Illuminate\Support\Facades\Hash;

class LoginService extends BaseLoginService{

    public function RegisterClientWithEmail($inputLogin){

        $resultExp = [
            "isValid" => false ,
            "existLastRequest" => false ,
            "token" => null ,
            "title" => "",
            "msg" => "",
            "otpSend" => "",
        ];

        $resultCheck = null;
        /// if input is email
        if ($this->checkValidatorEmail($inputLogin)){
            $resultExp["isValid"] = true;
            $resultCheck = $this->checkInputIsEmail($inputLogin);
        }
        /// if input is phone
        else if($this->checkValidatorPhone($inputLogin)){
            $resultExp["isValid"] = true;
            $resultCheck = $this->checkInputIsPhone($inputLogin);
        }

        if ($resultCheck != null){
            if (isset($resultCheck["existLastRequest"])){
                $resultExp["existLastRequest"] = $resultCheck["existLastRequest"];
            }
            if (isset($resultCheck["token"])){
                $resultExp["token"] = $resultCheck["token"];
            }
            if (isset($resultCheck["otpSend"])){
                $resultExp["otpSend"] = $resultCheck["otpSend"];
            }
        }


        //===============================
        $resultExp["title"] = "";
        $resultExp["msg"] = "";
        if (!$resultExp["isValid"]){
            $error = $this->getErrorInValidInputRequest();
            $resultExp["title"] = $error["title"];
            $resultExp["msg"] = $error["msg"];
        }
        else if ($resultExp["existLastRequest"]){
            $resultExp["isValid"] = false;
            $error = $this->getErrorExistRequestInPeriodMaxTime();
            $resultExp["title"] = $error["title"];
            $resultExp["msg"] = $error["msg"];
        }
        else if ($resultExp["token"] == null){
            $resultExp["isValid"] = false;
            $error = $this->getErrorSendEmailOrSMS();
            $resultExp["title"] = $error["title"];
            $resultExp["msg"] = $error["msg"];
        }

        return $resultExp;
    }




    public function SendOtpTokenUserExist($inputLogin){

        $resultExp = [
            "isValid" => false ,
            "token" => null
        ];

        /// if input is email
        if ($resultExp["token"] == null){
            $resultExp = $this->checkInputIsEmail($inputLogin , false);
        }
        /// if input is phone
        if ($resultExp["token"] == null){
            $resultExp = $this->checkInputIsPhone($inputLogin , false);
        }

        return $resultExp;
    }



    public function ResendTokenToClient($token){

        $otp = $this->otpRepository->existOtpRequest($token , 0 , false);
        $resultExp = [
            "title" => "",
            "msg" => "",
            "newToken" => null,
            "otpSend" => "",
        ];


        if (!empty($otp)){
            $resultSend = $this->sendOtpTokenClient($otp->user , $otp->input_login , $otp->type);
            $resultExp["newToken"] = $resultSend["token"];
            $resultExp["otpSend"] = $resultSend["otpSend"];
        }


        if ( $resultExp["newToken"] == null){
            $error = $this->getErrorInValidResendTokenRequest();
            $resultExp["title"] = $error["title"];
            $resultExp["msg"] = $error["msg"];
        }

        return $resultExp;
    }





    ///// =============================================

    private function checkInputIsEmail($inputLogin , $createUser=true){
        $resultExp = [
            "token" => null ,
            "existLastRequest" => true ,
            "isValid" => false ,
            "otpSend" => null ,
        ];

        $type = $this->otpRepository->getTypeOtp("email");


        if (!$this->otpRepository->CheckExistRequestInPeriodMaxTimeLast($inputLogin , $type)){

            $resultExp["existLastRequest"] = false;
            $user = $this->userRepository->GetUserWithEmail($inputLogin);

            if (empty($user) && $createUser){
                $user = $this->createNewUser($inputLogin);
            }
            if ($user != null){
                $resultExp["isValid"] = true;
                $resultSend = $this->sendOtpTokenClient($user , $inputLogin , $type);
                $resultExp["token"] = $resultSend["token"];
                $resultExp["otpSend"] = $resultSend["otpSend"];
            }
        }
        return $resultExp;
    }

    private function checkInputIsPhone($inputLogin, $createUser=true){
        $resultExp = [
            "token" => null  ,
            "existLastRequest" => true ,
            "isValid" => false ,
            "otpSend" => null ,
        ];

        $type = $this->otpRepository->getTypeOtp("mobile");
        if (!$this->otpRepository->CheckExistRequestInPeriodMaxTimeLast($inputLogin , $type)){
            $resultExp["existLastRequest"] = false;
            $inputLogin = filterPhoneNumber($inputLogin);
            $user = $this->userRepository->GetUserWithPhone($inputLogin);
            if (empty($user) && $createUser){
                $user = $this->createNewUser("" , $inputLogin);
            }
            if ($user != null){
                $resultExp["isValid"] = true;
                $resultSend = $this->sendOtpTokenClient($user , $inputLogin , $type);
                $resultExp["token"] = $resultSend["token"];
                $resultExp["otpSend"] = $resultSend["otpSend"];
            }
        }

        return $resultExp;
    }

    private function createNewUser($email=null , $mobile=null){
        if ($email != null || $mobile != null){
            $newUser["password"] = Hash::make("1234567890");
            $newUser["activation"] = 0;

            if ($email != null ){
                $newUser["email"] = $email;
            }
            else{
                $newUser["mobile"] = $mobile;
            }

            return $this->userRepository->addResult($newUser);
        }
        return null;
    }


    protected function sendOtpTokenClient($user , $inputLogin , $type ){

        $otpSend = "";
        $token = null;

        /// create token OTP
        $result = $this->otpRepository->createTokenOTP($user->id , $inputLogin , $type);

        /// send sms for user
        /*if ($type==0){
            $resultSendSms = (new PhoneBaseService())->sendMessage( ["otpCode" => $result["code"] ] , MessageOtpClient::$messageName ,  $inputLogin);
            if ($resultSendSms->isStatus()){
                $otpSend = $resultSendSms->getMyPhone();
                $token = $result["token"];
            }
        }
        /// send email for user
        else*/ if ($type == 1){

            $resultSendEmail = (new Emails())->sendTokenEmailForClientLogin($result["code"] , $inputLogin);

            if ($resultSendEmail){
                $token = $result["token"];
            }
        }

        return [
            "token" => $token ,
            "otpSend" => $otpSend ,
        ];


        /**/
    }

}
