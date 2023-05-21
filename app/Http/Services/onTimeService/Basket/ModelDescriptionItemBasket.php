<?php
namespace App\Http\Services\onTimeService\Basket;

class ModelDescriptionItemBasket{

    private $descriptionTitle;
    private $descriptionValue;

    /**
     * @return mixed
     */
    public function getDescriptionTitle()
    {
        return $this->descriptionTitle;
    }

    /**
     * @param mixed $descriptionTitle
     */
    public function setDescriptionTitle($descriptionTitle)
    {
        $this->descriptionTitle = $descriptionTitle;
    }

    /**
     * @return mixed
     */
    public function getDescriptionValue()
    {
        return $this->descriptionValue;
    }

    /**
     * @param mixed $descriptionValue
     */
    public function setDescriptionValue($descriptionValue)
    {
        $this->descriptionValue = $descriptionValue;
    }



    public function toArray()
    {
        return [
            "title" =>$this->getDescriptionTitle() ,
            "value" =>$this->getDescriptionValue() ,
        ];
    }

}
