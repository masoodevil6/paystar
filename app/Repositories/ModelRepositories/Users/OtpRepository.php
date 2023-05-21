<?php
namespace App\Repositories\ModelRepositories\Users;

use App\Models\Users\Otp;
use App\Repositories\InterFaceRepositories\Users\IOtpRepository;

use App\Repositories\ModelRepositories\BaseRepository;
use Carbon\Carbon;
use Illuminate\Support\Str;

/**
 * @template-extends BaseRepository<Otp>
 * @template-implements  IOtpRepository<Otp>
 */
class OtpRepository extends BaseRepository implements IOtpRepository {

    private $maxTimeRequest= 2;
    private $expireLoginWithTokenApi= 7;

    public function __construct()
    {
        parent::__construct(new Otp());
    }



    /**
     * @inheritDoc
     */
    function CheckExistRequestInPeriodMaxTimeLast($inputLogin, $type)
    {
        $request = $this->model
            ->where("input_login" , $inputLogin)
            ->where("type" , $type)
            ->where("created_at" , ">=" , Carbon::now()->subMinutes($this->maxTimeRequest)->toDateTimeString())
            ->first();

        if (!empty($request) && $request!=null){
            return true;
        }

        return  false;
    }



    /**
     * @inheritDoc
     */
    function createTokenOTP($userId, $inputLogin, $type, $checkStatus = false)
    {
        $otpCode = rand(111111 , 999999);
        $token = Str::random(60);
        $status = true;
        $otpInput = [
            "token" => $token ,
            "user_id" => $userId ,
            "otp_code" => $otpCode ,
            "input_login" => $inputLogin ,
            "type" => $type ,
        ];

        $lastToken = "";
        if ($checkStatus){
            $lastRequest =
                $this->model
                    ->where("user_id" , $userId)
                    ->where("created_at" , ">=" , Carbon::now()->subMinutes($this->maxTimeRequest)->toDateTimeString())
                    ->first();

            if (empty($lastRequest)){
                $status = true;
            }
            else{
                $lastToken = $lastRequest->token;
                $status = false;
            }
        }

        if ($status == true){
            $this->model->create($otpInput);
        }

        return [
            "code" => $otpCode ,
            "token" => $token ,
            "status" => $status ,
            "last_token" => $lastToken
        ];
    }

    /**
     * @inheritDoc
     */
    function checkLastLogin($token)
    {
        return $this->model
            ->where("used" , 1)
            ->where("status" , 1)
            ->where("token" , $token)
            ->where("created_at" , ">=" , Carbon::now()->subYears($this->expireLoginWithTokenApi)->toDateTimeString())
            ->first();
    }

    /**
     * @inheritDoc
     */
    function UpdateUsedTokenOtp(Otp $otp) :bool
    {
        return $this->updateResult($otp ,
            [
                "used" => 1 ,
                "status"=> 1
            ]
        );
    }

    /**
     * @inheritDoc
     */
    public function existOtpRequest($token, $userId = 0 , $checkTime=true)
    {
        $otp = $this->model
            ->where("token" , $token)
            ->where("used" , 0);

        if ($checkTime){
            $otp =$otp->where("created_at" , ">=" , Carbon::now()->subMinutes($this->maxTimeRequest)->toDateTimeString());
        }
        if ($userId > 0){
            $otp =$otp->where("user_id" , $userId);
        }
        $otp = $otp->first();

        return $otp;
    }

    /**
     * @inheritDoc
     */
    public function getTypeOtp($typeTitle){
        foreach ($this->model->types As $value){
            if ($value["title"] == $typeTitle){
                return $value["type"];
            }
        }
        return false;
    }

    /**
     * @inheritDoc
     */
    public function getTypeValueOtp($typeId){
        foreach ($this->model->types As $value){
            if ($value["type"] == $typeId){
                return $value["title"];
            }
        }
        return false;
    }

    /**
     * @inheritDoc
     */
    function getMaxTimeRequest()
    {
        return $this->maxTimeRequest;
    }
    /**
     * @inheritDoc
     */
    function getExpireLoginWithTokenApi()
    {
        return $this->expireLoginWithTokenApi;
    }


    // --------------------------------------------------

    /**
     * @inheritDoc
     */
    function deleteOtpCodeExpiredLastDay(){
        $this->model
            ->where("created_at" , "<=" , Carbon::now()->subDay(1)->toDateTimeString())
            ->delete();
    }



}
