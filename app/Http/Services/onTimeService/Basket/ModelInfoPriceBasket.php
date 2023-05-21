<?php
namespace App\Http\Services\onTimeService\Basket;

use Illuminate\Support\Facades\Config;

class ModelInfoPriceBasket{

    private $realPrice = 0;
    private $offPrice = 0;
    private $isEmptyBasket = true;



    public function getRealPrice()
    {
        return $this->realPrice;
    }

    public function getRealPriceText()
    {
        return persianPriceFormat($this->getRealPrice());
    }

    public function getRealPriceTextPass()
    {
        return  $this->getRealPriceText(). " " . Config::get("app.passPrice");
    }

    public function setRealPrice($realPrice)
    {
        $this->realPrice = $realPrice;
    }




    public function getOffPrice()
    {
        return $this->offPrice;
    }

    public function getOffPriceText()
    {
        return persianPriceFormat($this->getOffPrice());
    }

    public function getOffPriceTextPass()
    {
        return  $this->getOffPriceText(). " " . Config::get("app.passPrice");
    }

    public function setOffPrice($offPrice)
    {
        $this->offPrice = $offPrice;
    }




    public function getTotalPrice()
    {
        return ($this->realPrice - $this->offPrice);
    }

    public function getTotalPriceText()
    {
        return persianPriceFormat($this->getTotalPrice());
    }

    public function getTotalPriceTextPass()
    {
        return  $this->getTotalPriceText(). " " . Config::get("app.passPrice");
    }





    public function isEmptyBasket()
    {
        return $this->isEmptyBasket;
    }

    public function setIsEmptyBasket(bool $isEmptyBasket)
    {
        $this->isEmptyBasket = $isEmptyBasket;
    }



    public function toArray(){
        return [
           "realPrice" => $this->getRealPrice() ,
           "realPriceText" => $this->getRealPriceText() ,
           "realPriceTextPass" => $this->getRealPriceTextPass() ,

           "offPrice" => $this->getOffPrice() ,
           "offPriceText" => $this->getOffPriceText() ,
           "offPriceTextPass" => $this->getOffPriceTextPass() ,

            "totalPrice" => $this->getTotalPrice() ,
            "totalPriceText" => $this->getTotalPriceText() ,
            "totalPriceTextPass" => $this->getTotalPriceTextPass() ,

            "isEmptyBasket" => $this->isEmptyBasket()
        ];
    }

}
