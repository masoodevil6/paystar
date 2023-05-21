<?php
namespace App\Http\Services\onTimeService\Basket;


use Illuminate\Support\Collection;

class ModelListBasket{

    private $listBasket = [];

    public function addBasket(ModelBasket $itemBasket){
        array_push($this->listBasket , $itemBasket);
    }

    public function getBasket($index) :ModelBasket|null
    {
        if (isset($this->listBasket[$index]) && $this->listBasket[$index] != null && $this->listBasket[$index] instanceof ModelBasket){
            return $this->listBasket[$index];
        }
        return null;
    }

    public function getCollectBasket():Collection
    {
        return  collect($this->listBasket);
    }

    public function getSize()
    {
        return  sizeof($this->listBasket);
    }


}
