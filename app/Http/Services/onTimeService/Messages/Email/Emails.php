<?php
namespace App\Http\Services\onTimeService\Messages\Email;



class Emails extends EmailService {


    public function sendTokenEmailForClientLogin($otp_Code , $userEmail){

        $details = [
            "title" => "ایمیل فعال سازی" ,
            "body" => "کد فعال سازی شما: "." <b style='margin: 0 20px'>$otp_Code</b>"
        ];

        $this->setDetails($details);
        $this->setFrom();
        $this->setSubject("کد اهراز هویت");
        $this->setTo($userEmail);

        return $this->fire();
    }


    public function sendVerifyEmailForClientEmail($otp_Code , $userEmail){

        $details = [
            "title" => "کد اعتبار سنجی ایمیل" ,
            "body" => "کد تایید: "." <b style='margin: 0 20px'>$otp_Code</b>"
        ];

        $this->setDetails($details);
        $this->setFrom();
        $this->setSubject("کد اعتبار سنجی");
        $this->setTo($userEmail);

        return $this->fire();
    }


    public function sendVerifyEmailForChangePasswordAdmin($token , $userEmail){

        $details = [
            "title" => "لینک تایید درخواست تغییر رمز پنل:" ,
            "body" => "
<a href='".route("admin.password.get-request-token" , $token)."' style='border-radius:5px ;border-color:#777575;border-style:solid;border-width:2px;line-height:30px;margin:10px auto;background-color:#5092ff;font-family: Tahoma;color:white;text-decoration:none; display: block;width: 100px;text-align: center;'   class='btn btn-success d-block mx-auto mt-2'>
    <b>
            لـینک تایـید
    </b>
</a>"
        ];

        $this->setDetails($details);
        $this->setFrom();
        $this->setSubject("تغییر رمز عبور");
        $this->setTo($userEmail);

        return $this->fire();
    }

}
