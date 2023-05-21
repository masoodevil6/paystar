<?php

namespace App\Http\Controllers\API\User;

use App\Http\Controllers\API\BaseApiController;
use App\Http\Controllers\API\Order\MainOrderClient;
use App\Http\Services\Banks\BanksService\Models\ModelResultPayment;
use App\Http\Services\ContextService\Payment\BaseService\Models\ResultVerifyPaymentModel;
use App\Repositories\ContextRepository;
use Illuminate\Http\Request;
use function response;

class UserOrderApiController extends MainOrderClient
{

    /* @method POST
     * ====================================
     * @url /user/orders/get-list-order?resNum={resNum}&isFinish={isFinish}
     *====================================
     * @param string $resNum (query)
     * @param int $isFinish (query)
     * ====================================
     * @return array
     *   [
     *        [
     *         'id'(int|null) ,
     *         'res_num'(string|null) ,
     *         'code_off'(string|null) ,
     *         'code_price'(int|null) ,
     *         'real_price'(int|null) ,
     *         'off_price'(int|null) ,
     *         'total_Price'(int|null) ,
     *         'is_finish'(boolean|null) ,
     *         'description_finish'(string|null) ,
     *         'user_id'(int|null) ,
     *         'created_at'(date|null) ,
     *         'updated_at'(date|null) ,
     *         'order_baskets'(array|null)=>[...] ,
     *        ]
     *        , ....
     *  ]
     *
     */
    public function getListOrder(Request $request){
        $resNum = "";
        if ($request->has("resNum")){
            $resNum = $request->get("resNum");
        }
        $isFinish = -1;
        if ($request->has("isFinish")){
            $isFinish = $request->get("isFinish");
        }
        $userOrders = ContextRepository::OrderRepository()->GetListOrdersUser($resNum , $isFinish);
        return $userOrders;
    }





    /* @method POST
     * ====================================
     * @url /user/orders/get-info-order
     *====================================
     * @param string $orderResNum (Request)
     * ====================================
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
     *
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
     *      ],
     *
     *     'infoPayment'=>[
     *         'isStatusPayment'(boolean|null) ,
     *         'statusPayment'(string|null) ,
     *
     *         'code'(string|null) ,
     *         'message'(string|null) ,
     *         'fullMessage'(string|null) ,
     *
     *         'resNum'(string|null) ,
     *         'refNum'(string|null) ,
     *
     *         'amount'(string|null) ,
     *         'intAmount'(int|null) ,
     *         'intAmount'(int|null) ,
     *
     *         'description'(string|null) ,
     *         'paymentName'(string|null) ,
     *         'orderId'(int|null) ,
     *         'email'(string|null) ,
     *         'phone'(string|null)
     *      ],
     *
     *     'listPayment'=>[
     *          [
     *            'isStatusPayment'(boolean|null) ,
     *            'statusPayment'(string|null) ,
     *
     *            'code'(string|null) ,
     *            'message'(string|null) ,
     *            'fullMessage'(string|null) ,
     *
     *            'resNum'(string|null) ,
     *            'refNum'(string|null) ,
     *
     *            'amount'(string|null) ,
     *            'intAmount'(int|null) ,
     *            'intAmount'(int|null) ,
     *
     *            'description'(string|null) ,
     *            'paymentName'(string|null) ,
     *            'orderId'(int|null) ,
     *            'email'(string|null) ,
     *            'phone'(string|null)
     *          ] ,
     *          ...
     *      ],
     *
     *
     *     'isExistSuccessPayment'(boolean|null) ,
     *     'existRecord'(boolean|null) ,
     *
     *     'CodeOff'(string|null) ,
     *     'CodeOffPrice'(int|null) ,
     *     'CodeOffPriceText'(string|null) ,
     *     'CodeOffPriceTextPass'(string|null) ,
     * ]
     */
    public function getInfoOrder(Request $request){
        if ($request->has("orderResNum")){
            $orderInfo = ContextRepository::OrderRepository()->GetInfoOrderUser($request->get("orderResNum"));

            if (!empty($orderInfo) && $orderInfo != null){

                $infoPayment = null;
                if ($orderInfo->getInfoPayment() != null ){
                    $infoPayment = $orderInfo->getInfoPayment()->toArray();
                }

                $listPayment=[];
                for ($i=0;$i<$orderInfo->getListPayment()->getSize() ; $i++){
                    /**@var ResultVerifyPaymentModel $itemPayment*/
                    $itemPayment = $orderInfo->getListPayment()->get($i);
                    if ($itemPayment != null){
                        array_push($listPayment , $itemPayment->toArray());
                    }
                }

                return [
                    "listBasket" => $this->getArrayItemsBasket($orderInfo->getListBasket()) ,
                    "infoPrice" => $this->getInfoPriceOrder($orderInfo->getInfoPrice()) ,

                    "isExistSuccessPayment" => $orderInfo->isExistSuccessPayment() ,
                    "existRecord" => $orderInfo->isExistRecord() ,

                    "codeOff" => $orderInfo->getCodeOff() ,
                    "codeOffPrice" => $orderInfo->getCodeOffPrice() ,
                    "codeOffPriceText" => $orderInfo->getCodeOffPriceText() ,
                    "codeOffPriceTextPass" => $orderInfo->getCodeOffPriceTextPass() ,

                    "userFullName" => $orderInfo->getUserFullName() ,
                    "orderResNum" => $orderInfo->getOrderResNum() ,

                    "infoPayment"=>$infoPayment ,
                    "listPayment"=>$listPayment ,
                ];

            }


        }
        return abort(404);
    }







}
