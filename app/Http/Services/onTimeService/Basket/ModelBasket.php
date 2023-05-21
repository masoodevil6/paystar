<?php
namespace App\Http\Services\onTimeService\Basket;

use Illuminate\Support\Facades\Config;

class ModelBasket{

    private $itemId = 0;
    private $itemName;
    private $itemDescription = [];

    private $itemCookie;
    private $itemOrderId = 0;
    private $itemOrderBasketableType;
    private $itemOrderBasketableId = 0;

    private $itemOffPrice = 0;
    private $itemPrice = 0;

    private $submitted = false;




    /**
     * @return mixed
     */
    public function getItemId()
    {
        return $this->itemId;
    }

    /**
     * @param mixed $itemId
     */
    public function setItemId($itemId)
    {
        $this->itemId = $itemId;
    }







    /**
     * @return mixed
     */
    public function getItemName()
    {
        return $this->itemName;
    }

    /**
     * @param mixed $itemName
     */
    public function setItemName($itemName)
    {
        $this->itemName = $itemName;
    }




    /**
     * @return mixed
     */
    public function getItemDescription()
    {
        return $this->itemDescription;
    }

    /**
     * @param mixed $itemDescription
     */
    public function setItemDescription($itemDescription)
    {
        $this->itemDescription = $itemDescription;
    }






    /**
     * @return mixed
     */
    public function getItemCookie()
    {
        return $this->itemCookie;
    }

    /**
     * @param mixed $itemCookie
     */
    public function setItemCookie($itemCookie)
    {
        $this->itemCookie = $itemCookie;
    }








    /**
     * @return mixed
     */
    public function getItemOrderId()
    {
        return $this->itemOrderId;
    }

    /**
     * @param mixed $itemOrderId
     */
    public function setItemOrderId($itemOrderId)
    {
        $this->itemOrderId = $itemOrderId;
    }






    /**
     * @return mixed
     */
    public function getItemOrderBasketableType()
    {
        return $this->itemOrderBasketableType;
    }

    /**
     * @param mixed $itemOrderBasketableType
     */
    public function setItemOrderBasketableType($itemOrderBasketableType)
    {
        $this->itemOrderBasketableType = $itemOrderBasketableType;
    }







    public function getItemOrderBasketableId()
    {
        return $this->itemOrderBasketableId;
    }

    public function setItemOrderBasketableId($itemOrderBasketableId)
    {
        $this->itemOrderBasketableId = $itemOrderBasketableId;
    }





    public function isSubmitted()
    {
        return $this->submitted;
    }

    public function setSubmitted($submitted)
    {
        $this->submitted = $submitted;
    }











    public function getItemOffPrice()
    {
        return $this->itemOffPrice;
    }

    public function getItemOffPriceText()
    {
        return persianPriceFormat($this->getItemOffPrice());
    }

    public function getItemOffPriceTextPass()
    {
        return $this->getItemOffPriceText(). " " . Config::get("app.passPrice");
    }

    public function setItemOffPrice($itemOffPrice)
    {
        $this->itemOffPrice = $itemOffPrice;
    }






    public function getItemPrice()
    {
        return $this->itemPrice;
    }

    public function getItemPriceText()
    {
        return persianPriceFormat($this->getItemPrice());
    }

    public function getItemPriceTextPass()
    {
        return $this->getItemPriceText(). " " . Config::get("app.passPrice");
    }

    public function setItemPrice($itemPrice)
    {
        $this->itemPrice = $itemPrice;
    }




    public function getItemTotalPrice()
    {
        return ((int)$this->itemPrice - (int)$this->itemOffPrice);
    }

    public function getItemTotalPriceText()
    {
        return number_format($this->getItemTotalPrice());
    }

    public function getItemTotalPriceTextPass()
    {
        return $this->getItemTotalPriceText(). " " . Config::get("app.passPrice");
    }






    public function toArray(){

        $itemDescription = $this->getDescriptionToArray();

        return [
            "itemId" => $this->getItemId() ,
            "itemName" => $this->getItemName() ,
            "itemDescription" => $itemDescription ,

            "itemOrderId" => $this->getItemOrderId(),

            "itemOffPrice" => $this->getItemOffPrice(),
            "itemOffPriceText" => $this->getItemOffPriceText(),
            "itemOffPriceTextPass" => $this->getItemOffPriceTextPass(),

            "itemPrice" => $this->getItemPrice(),
            "itemPriceText" => $this->getItemPriceText(),
            "itemPriceTextPass" => $this->getItemPriceTextPass(),

            "itemTotalPrice" => $this->getItemTotalPrice(),
            "itemTotalPriceText" => $this->getItemTotalPriceText(),
            "itemTotalPriceTextPass" => $this->getItemTotalPriceTextPass(),
        ];
    }


    public function getDescriptionToArray(){
        $itemDescription = [];
        $itemBasketDescription = $this->getItemDescription();


        if (is_array($itemBasketDescription)){

            foreach ($itemBasketDescription as $key => $item){

                if ($item instanceof  ModelDescriptionItemBasket){
                    /**@var ModelDescriptionItemBasket  $item*/
                    $itemDescription[] = $item->toArray();
                }

                if (is_array($item) && isset($item["title"]) && isset($item["value"]) ){
                    $itemDescription[] = $item;
                }

                /*else if (!empty($item) && $item!=null && !is_array($item) ){
                    $itemDescription[] = ["title" => $key+1 , "value" =>$item];
                }*/

            }

        }
        else{
            $itemDescription = [
                [
                    "title" => 1 ,
                    "value" => $itemBasketDescription
                ]
            ];
        }

        return $itemDescription;
    }


}
