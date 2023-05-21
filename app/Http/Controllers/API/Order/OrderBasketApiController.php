<?php

namespace App\Http\Controllers\API\Order;

use App\Models\Subscribes\Subscribe;
use App\Repositories\ContextRepository;
use Illuminate\Http\Request;

class OrderBasketApiController extends MainOrderClient
{

    /* @method GET
     * ====================================
     * @url /order/basket/get-list-basket/{cookie}
     *====================================
     * @param string $cookie (Query)
     * ====================================
     * @return array[
     *   'listBasket' => [
     *          [
     *            'itemId'(int|null) ,
     *            'itemName'(string|null) ,
     *            'itemDescription'(array|null) => [
     *                                            "title"(string) ,
     *                                            "value"(string)
     *                                          ],
     *
     *             'itemOrderId'(int|null) ,
     *
     *             'itemOffPrice'(int|null) ,
     *             'itemOffPriceText'(string|null) ,
     *
     *             'itemPrice'(int|null) ,
     *             'itemPriceTextPass'(string|null) ,
     *          ],
     *          ...
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
    public function getListBasket($cookie){

        return $this->getListBaskets($cookie);
    }







    /* @method POST
     * ====================================
     * @url /order/basket/add-to-basket/
     *====================================
     * @param string $cookie (Request)
     * @param string $slug (Request)
     * ====================================
     * @return int
     */
    public function addToBasket(Request $request ){

        if ($request->has("slug") && $request->has("cookie")){
            $subscribe = ContextRepository::SubscribeRepository()->GetInfoSubscribe($request-> slug);

            if (!empty($subscribe)){
                $statusAdd = ContextRepository::OrderBasketRepository()->addToBasket(Subscribe::class , $subscribe->id , $request-> cookie);
                if (!empty($statusAdd) && $statusAdd != null ){
                    return $statusAdd->id;
                }
            }
        }
        return abort(404);
    }





    /* @method POST
     * ====================================
     * @url /order/basket/delete-basket/
     *====================================
     * @param string $cookie (Request)
     * @param int $basketId (Request)
     * ====================================
     * @return array[
     *    'listBasket' => [
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
    public function deleteFromBasket(Request $request){
        if ($request->has("basketId") && $request->has("cookie")){

            $resultDelete = ContextRepository::OrderBasketRepository()->deleteFromBasket(
                $request-> basketId ,
                $request-> cookie ,
            );
            if ($resultDelete){
                return $this->getListBasket($request-> cookie);
            }
        }
        return abort(404);
    }


}
