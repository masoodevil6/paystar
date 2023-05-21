<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Services\onTimeService\Login\CheckLogin;
use App\Http\Services\onTimeService\Login\ConfirmLoginService;
use App\Http\Services\onTimeService\Login\LoginService;
use Illuminate\Http\Request;

class LoginApiController extends Controller
{



    /* @method POST
     * ====================================
     *  url=> /login/check-last-login
     *====================================
     * header-bearer => token
     * ====================================
     * "inputLogin" => null
     * "isValid" => false
     * "status" => false
     * "title" => ""
     * "msg" => ""
     */
    public function checkTokenAndEmail(Request $request , CheckLogin $checkLogin){
        $token = $request->bearerToken();
        return $checkLogin->checkLastLogin($token);
    }





    /*  @method POST
     * ====================================
     *  @url /login/register
     *====================================
     * @param string inputLogin (Request)
     * ====================================
     * @return array[
     *       "isValid" => false
     *       "inputLogin" => null
     *       "token" => null
     *       "title" => ""
     *       "msg" => ""
     *       "timerDown" => 0
     *       "otpType" => null
     *       "otpSend" => null
     * ]
     */
    public function registerEmailOrPhoneClient(Request $request, LoginService $LoginService){

        $resultExp = [
            "isValid" => false ,

            "token" => null ,
            "inputLogin" => null ,

            "title" => "",
            "msg" => "",

            "timerDown" => 0,
            "otpType" => 0 ,
            "otpSend" => "" ,
        ];

        $resultStep = $LoginService->RegisterClientWithEmail($request->inputLogin);
        $resultExp["otpSend"] = $resultStep["otpSend"];
        $resultExp["token"] = $resultStep["token"];
        $resultExp["title"] = $resultStep["title"];
        $resultExp["msg"] = $resultStep["msg"];

        if($resultStep["isValid"] && !empty($resultStep["token"])){
            $infoRequest = $this->ReadyAndValidatorRequestToken($resultExp["token"]);
            if ($infoRequest["isValid"]){
                $resultExp["isValid"] = $infoRequest["isValid"];
                $resultExp["inputLogin"] = $infoRequest["inputLogin"];
                $resultExp["otpType"] = $infoRequest["otpType"];
                $resultExp["timerDown"] = $infoRequest["timerDown"];
                $resultExp["title"] = $infoRequest["title"];
                $resultExp["msg"] = $infoRequest["msg"];
            }
        }

        return $resultExp;
    }





    /* @method POST
     * ====================================
     *  url=> /login/confirm-login
     * ====================================
     * header-bearer => token
     * int => otp_code
     * ====================================
     * "inputLogin" => null
     * "isValid" => false
     * "status" => false
     * "user" => null
     * "title" => ""
     * "msg" => ""
     * "exp => 0
     */
    public function ConfirmLoginClient(Request $request ,ConfirmLoginService $confirmLoginService){
        $token = $request->bearerToken();
        return  $confirmLoginService->ConfirmLoginClient($token , $request->otp_code);
    }






    /////==============================================================

    /*
     * "isValid" => false,
     * "timerDown" => 0,
     * "otpType" => null ,
     * "inputLogin" => null ,
     * "title" => "" ,
     * "msg" => "" ,*/
    private function ReadyAndValidatorRequestToken($token){
        $confirmLoginService = new ConfirmLoginService();
        return $confirmLoginService->ReadyFormSendOtp($token);
    }



}
