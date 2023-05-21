<?php
namespace App\Tools\Models\Repositories\Banks;

class ModelPublicBankPayment{

    private $bankName = 0;
    private $resNum;
    private $refNum;
    private $amount = 0;
    private $phone;
    private $email;

    /**
     * @return int
     */
    public function getBankName()
    {
        return $this->bankName;
    }

    /**
     * @param int $bankName
     */
    public function setBankName($bankName)
    {
        $this->bankName = $bankName;
    }




    /**
     * @return mixed
     */
    public function getResNum()
    {
        return $this->resNum;
    }

    /**
     * @param mixed $resNum
     */
    public function setResNum($resNum)
    {
        $this->resNum = $resNum;
    }

    /**
     * @return mixed
     */
    public function getRefNum()
    {
        return $this->refNum;
    }

    /**
     * @param mixed $refNum
     */
    public function setRefNum($refNum)
    {
        $this->refNum = $refNum;
    }

    /**
     * @return int
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * @param int $amount
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;
    }

    /**
     * @return mixed
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * @param mixed $phone
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }




}