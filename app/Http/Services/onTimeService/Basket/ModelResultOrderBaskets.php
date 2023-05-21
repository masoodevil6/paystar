<?php
namespace App\Http\Services\onTimeService\Basket;


use App\Tools\Models\IModelBaseList;
use App\Tools\Models\ModelBaseList;

class ModelResultOrderBaskets{


    /**@var IModelBaseList<ModelBasket> $listBasket  */
    private $listBasket;

    /**@var ModelInfoPriceBasket $infoPrice  */
    private $infoPrice;


    //---------------------------------------------------------------
    function __construct()
    {
        $this->listBasket = new ModelBaseList(ModelBasket::class);
        $this->infoPrice = new ModelInfoPriceBasket();
    }

    //---------------------------------------------------------------


    /**
     * @return IModelBaseList<ModelBasket>
     */
    public function getListBasket() :IModelBaseList
    {
        return $this->listBasket;
    }

    /**
     * @param ModelBaseList $listBasket
     */
    public function setListBasket(ModelBaseList $listBasket)
    {
        $this->listBasket = $listBasket;
    }



    /**
     * @return ModelInfoPriceBasket
     */
    public function getInfoPrice() :ModelInfoPriceBasket
    {
        return $this->infoPrice;
    }

    /**
     * @param ModelInfoPriceBasket $infoPrice
     */
    public function setInfoPrice(ModelInfoPriceBasket $infoPrice)
    {
        $this->infoPrice = $infoPrice;
    }


}
