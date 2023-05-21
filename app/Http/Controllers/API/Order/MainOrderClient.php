<?php

namespace App\Http\Controllers\API\Order;

use App\Http\Controllers\API\BaseApiController;
use App\Http\Services\onTimeService\Basket\BaseBasket;
use App\Http\Services\onTimeService\Basket\ModelBasket;
use App\Http\Services\onTimeService\Basket\ModelInfoPriceBasket;
use App\Repositories\ContextRepository;
use App\Tools\Models\IModelBaseList;


class MainOrderClient extends BaseApiController
{

    /**@param string $cookie
     * @return array[
     *   'listBasket'(class:IModelBaseList) ,
     *   'infoPrice'(class:ModelInfoPriceBasket)
     */
    protected function getBasketsAndInfoPrice($cookie){
        $resultBasket = ContextRepository::OrderBasketRepository()->getAllBasket($cookie);

        $baseBasket = new BaseBasket();
        $resultBasket = $baseBasket->getListModelBasket($resultBasket , true);

        $listBasket = $resultBasket->getListBasket();
        $infoPrice = $resultBasket->getInfoPrice();

        return [
            "listBasket" =>  $listBasket ,
            "infoPrice" => $infoPrice
        ];
    }







    /**@param string $cookie
     * @return array[
     *   'listBasket' => [
     *         'itemId'(int|null) ,
     *         'itemName'(string|null) ,
     *         'itemDescription'(array|null) => [
     *                                            "title"(string) ,
     *                                            "value"(string)
     *                                          ],
     *
     *         'itemOrderId'(int|null) ,
     *
     *         'itemOffPrice'(int|null) ,
     *         'itemOffPriceText'(string|null) ,
     *
     *         'itemPrice'(int|null) ,
     *         'itemPriceTextPass'(string|null) ,
     *     ] ,
     *     'infoPrice'=>[
     *         'realPrice'(int|null) ,
     *         'realPriceText'(string|null) ,
     *
     *         'offPrice'(int|null) ,
     *         'offPriceText'(string|null) ,
     *
     *         'totalPrice'(int|null) ,
     *         'totalPriceText'(string|null) ,
     *
     *         'isEmptyBasket'(boolean|null) ,
     *      ]
     * ]
     */
    protected function getListBaskets($cookie){

        $listBasketAndInfoPrice = $this->getBasketsAndInfoPrice($cookie);

        $listBasket = $this->getArrayItemsBasket($listBasketAndInfoPrice["listBasket"]);
        $infoPrice = $this->getInfoPriceOrder($listBasketAndInfoPrice["infoPrice"]);

        return [
            "listBasket" =>  $listBasket ,
            "infoPrice" => $infoPrice
        ];
    }







    /**@param string $cookie
     * @return int
     */
    protected function getTotalPriceOrder($cookie){
        $resultBasket = ContextRepository::OrderBasketRepository()->getAllBasket($cookie);

        $baseBasket = new BaseBasket();
        $resultBasket = $baseBasket->getListModelBasket($resultBasket , true);

        return $resultBasket->getInfoPrice()->getTotalPrice();
    }



    //=====================================================
    /**@param IModelBaseList $listBasket
     * @return array[
     *   'itemId'(int|null) ,
     *   'itemName'(string|null) ,
     *   'itemDescription'(array|null) => [
     *                                      "title"(string) ,
     *                                      "value"(string)
     *                                   ],
     *
     *   'itemOrderId'(int|null) ,
     *
     *   'itemOffPrice'(int|null) ,
     *   'itemOffPriceText'(string|null) ,
     *
     *   'itemPrice'(int|null) ,
     *   'itemPriceTextPass'(string|null) ,
     * ]
     */
    protected function getArrayItemsBasket($listBasket){
        $baskets=[];

        /**@var ModelBasket $itemBasket*/
        for ($i=0;$i<$listBasket->getSize();$i++){
            $itemBasket =  $listBasket->get($i);

            $baskets[] = $itemBasket->toArray();
        }

        return $baskets;
    }





    /**@param ModelInfoPriceBasket $infoPrice
     * @return array[
     *   'realPrice'(int|null) ,
     *   'realPriceText'(string|null) ,
     *
     *   'offPrice'(int|null) ,
     *   'offPriceText'(string|null) ,
     *
     *   'totalPrice'(int|null) ,
     *   'totalPriceText'(string|null) ,
     *
     *   'isEmptyBasket'(boolean|null) ,
     * ]
     */
    protected function getInfoPriceOrder($infoPrice){
        return $infoPrice->toArray();
    }


}
