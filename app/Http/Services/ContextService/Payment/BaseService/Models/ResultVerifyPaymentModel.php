<?php
namespace App\Http\Services\ContextService\Payment\BaseService\Models;

class ResultVerifyPaymentModel{

    private $statusPayment = false;   /// status of payment [pay success / pay failed]

    private $code = null;
    private $message = "در پردازش اطلاعات مشکلی رخ داده است";

    private $resNum = null;
    private $refNum = null;
    private $amount = 0;
    private $description = null;

    private $payment_name = null;

    private $orderId = null;
    private $userId =null;
    private $orderResNum = null;
    private $email = null;
    private $phone = null;



    public function isStatusPayment(): bool
    {
        return $this->statusPayment;
    }

    public function getStatusPayment()
    {
        if ($this->statusPayment){
            return "موفق";
        }
        return "نا موفق";
    }

    public function setStatusPayment(bool $status)
    {
        $this->statusPayment = $status;
    }







    public function getCode()
    {
        return $this->code;
    }

    public function setCode($code = null)
    {
        $this->code = $code;
    }





    public function getMessage()
    {
        return $this->message;
    }

    public function getFullMessage(){
        return "[".$this->getCode()."] ".$this->getMessage();
    }

    public function setMessage($message = null)
    {
        $this->message = $message;
    }








    public function getResNum()
    {
        return $this->resNum;
    }

    public function setResNum($resNum = null)
    {
        $this->resNum = $resNum;
    }







    public function getRefNum()
    {
        return $this->refNum;
    }

    public function setRefNum( $refNum = null)
    {
        $this->refNum = $refNum;
    }







    public function getAmount()
    {
        return number_format($this->amount) . " ریال";
    }

    public function getIntAmount()
    {
        return $this->amount/10;
    }

    public function setAmount( $amount = null)
    {
        $this->amount = $amount;
    }







    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription( $description = null)
    {
        $this->description = $description;
    }







    public function getPaymentName()
    {
        return $this->payment_name;
    }

    public function setPaymentName( $payment_name = null)
    {
        $this->payment_name = $payment_name;
    }






    public function getOrderId()
    {
        return $this->orderId;
    }

    public function setOrderId($orderId)
    {
        $this->orderId = $orderId;
    }





    public function getUserId()
    {
        return $this->userId;
    }

    public function setUserId($userId)
    {
        $this->userId = $userId;
    }










    public function getOrderResNum()
    {
        return $this->orderResNum;
    }


    public function setOrderResNum($orderResNum)
    {
        $this->orderResNum = $orderResNum;
    }








    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }




    public function getPhone()
    {
        return $this->phone;
    }

    public function setPhone($phone)
    {
        $this->phone = $phone;
    }




    public function toArray(){
        return [
            "isStatusPayment" => $this->isStatusPayment() ,
            "statusPayment" => $this->getStatusPayment() ,
            "code" => $this->getCode() ,
            "message" => $this->getMessage() ,
            "fullMessage" => $this->getFullMessage() ,
            "resNum" => $this->getResNum() ,
            "refNum" => $this->getRefNum() ,
            "amount" => $this->getAmount(),
            "intAmount" => $this->getIntAmount(),
            "description" => $this->getDescription(),
            "paymentName" => $this->getPaymentName(),
            "orderId" => $this->getOrderId(),
            "email" => $this->getEmail(),
            "phone" => $this->getPhone(),
        ];
    }


}
