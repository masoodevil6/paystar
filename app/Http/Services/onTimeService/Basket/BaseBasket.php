<?php
namespace App\Http\Services\onTimeService\Basket;

use App\Models\Orders\OrderBasket;
use App\Models\Subscribes\Subscribe;
use App\Tools\Models\ModelBaseList;
use Illuminate\Support\Facades\Config;

class BaseBasket {


    public function getListModelBasket($listBasket = [] , $resourceOriginal = false) :ModelResultOrderBaskets
    {
        $modelResultOrderBaskets = new ModelResultOrderBaskets();

        $modelListBasket =new ModelBaseList(ModelBasket::class);
        foreach ($listBasket as $itemBasket){

            if ($itemBasket->order_basketable_type == Subscribe::class){
                $itemModelBasket = $this->getInfoSubscribeInBasket($itemBasket , $resourceOriginal);
                if (!empty($itemModelBasket) && $itemModelBasket != null){
                    $modelListBasket->add($itemModelBasket);
                }
            }
        }
        $modelResultOrderBaskets->setListBasket($modelListBasket);
        $modelResultOrderBaskets->setInfoPrice($this->infoPriceBasket($modelListBasket));

        return $modelResultOrderBaskets;
    }


    //---------------------------------------

    private function getInfoSubscribeInBasket(OrderBasket $itemBasket , $resourceOriginal = false) : ModelBasket|null
    {

        if ($resourceOriginal){
            $subscribe = $itemBasket->orderBasketable;


            $itemModelBasket = $this->getInfoItemOrderBasketFromSubscribe($subscribe);
            if ($itemModelBasket != null && !empty($itemModelBasket)){

                $itemModelBasket->setItemId($itemBasket->id);
                $itemModelBasket->setItemCookie($itemBasket->cookie);
                $itemModelBasket->setItemOrderId($itemBasket->order_id);
                $itemModelBasket->setItemOrderBasketableType($itemBasket->order_basketable_type);
                $itemModelBasket->setItemOrderBasketableId($itemBasket->order_basketable_id);

                $itemModelBasket->setSubmitted($itemBasket->submitted);

                return $itemModelBasket;
            }
        }
        else{
            return $this->getInfoItemOrderBasketSubmiteded($itemBasket);
        }

        return null;
    }



    //---------------------------------------

    public function getInfoItemOrderBasketFromSubscribe(Subscribe $subscribe) : ModelBasket|null{
        if (!empty($subscribe) && $subscribe != null){
            $description = $this->getDescriptionBasketSubscribe($subscribe);


            $itemModelBasket = new ModelBasket();

            $itemModelBasket->setItemName($subscribe->title);
            $itemModelBasket->setItemDescription($description);
            $itemModelBasket->setItemOffPrice($subscribe->off_price);
            $itemModelBasket->setItemPrice($subscribe->real_price);

            return $itemModelBasket;
        }

        return null;
    }
    public function getDescriptionBasketSubscribe(Subscribe $subscribe){

        $description = [];

        if (!empty($subscribe) && $subscribe != null){
            $description[] = $this->addDescriptionModel(
                "مدت اشتراک",
                $subscribe->duration . " " . Config::get("app.passDuration")
            );
        }

        return $description;
    }


    private function getInfoItemOrderBasketSubmiteded(OrderBasket $itemBasket ){
        $itemModelBasket = new ModelBasket();
        $itemModelBasket->setItemId($itemBasket->id);
        $itemModelBasket->setItemName($itemBasket->name);
        $itemModelBasket->setItemDescription($itemBasket->description);
        $itemModelBasket->setItemOffPrice($itemBasket->off);
        $itemModelBasket->setItemPrice($itemBasket->price);

        $itemModelBasket->setItemCookie($itemBasket->cookie);
        $itemModelBasket->setItemOrderId($itemBasket->order_id);
        $itemModelBasket->setItemOrderBasketableType($itemBasket->order_basketable_type);
        $itemModelBasket->setItemOrderBasketableId($itemBasket->order_basketable_id);

        $itemModelBasket->setSubmitted($itemBasket->submitted);

        return $itemModelBasket;
    }




    private function infoPriceBasket(ModelBaseList $listBasket) : ModelInfoPriceBasket
    {
        $modelInfoPriceBasket = new ModelInfoPriceBasket();

        $realPrice=0;
        $offPrice=0;
        $isEmptyBasket = true;

        for($i=0 ; $i<$listBasket->getSize() ; $i++){
            /**@var ModelBasket $itemBasket*/
            $itemBasket = $listBasket->get($i);
            $isEmptyBasket = false;
            $realPrice += $itemBasket->getItemPrice();
            $offPrice += $itemBasket->getItemOffPrice();
        }
        $modelInfoPriceBasket->setRealPrice($realPrice);
        $modelInfoPriceBasket->setOffPrice($offPrice);
        $modelInfoPriceBasket->setIsEmptyBasket($isEmptyBasket);

        return $modelInfoPriceBasket;
    }




    private function addDescriptionModel($title , $value) :ModelDescriptionItemBasket
    {
        $modelDescriptionItemBasket = new ModelDescriptionItemBasket();
        $modelDescriptionItemBasket -> setDescriptionTitle($title);
        $modelDescriptionItemBasket -> setDescriptionValue($value);
        return $modelDescriptionItemBasket;
    }

}
