<?php
namespace App\Tools\Models\Repositories\Orders;

class ModelCheckCodeOffForPayment{

    private $codeOff = null;
    private $codeOffPrice = 0;


    /**
     * @return mixed
     */
    public function getCodeOff()
    {
        return $this->codeOff;
    }

    /**
     * @param mixed $codeOff
     */
    public function setCodeOff($codeOff)
    {
        $this->codeOff = $codeOff;
    }



    /**
     * @return mixed
     */
    public function getCodeOffPrice()
    {
        return $this->codeOffPrice;
    }

    /**
     * @param mixed $codeOffPrice
     */
    public function setCodeOffPrice($codeOffPrice)
    {
        $this->codeOffPrice = $codeOffPrice;
    }



}