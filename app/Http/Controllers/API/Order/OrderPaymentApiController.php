<?php

namespace App\Http\Controllers\API\Order;

use App\Http\Services\ContextService\ContextServiceRepository;
use App\Http\Services\ContextService\Payment\BaseService\Models\ResultVerifyPaymentModel;
use App\Http\Services\onTimeService\Basket\ModelBasket;
use App\Http\Services\onTimeService\Basket\ModelInfoPriceBasket;
use App\Repositories\ContextRepository;
use App\Tools\Models\IModelBaseList;
use Illuminate\Http\Request;

class OrderPaymentApiController extends MainOrderClient
{


    /* @method POST
     * ====================================
     * @url /order/payment/get-list-banks
     *====================================
     * ====================================
     * @return array[
     *   [
     *       [
     *          'class_name'(string|null) ,
     *          'image'(string|null) ,
     *          'image_title'(string|null) ,
     *          'image_alt'(string|null) ,
     *       ]
     *   ],
     *   ...
     */
    public function getListBanks(){
        return ContextRepository::BankRepository()->GetListPaymentThatActive();
    }





    /* @method POST
     * ====================================
     * @url /order/payment/check-code-off
     *====================================
     * @param string $cookie (Request)
     * @param string $codeOff (Request)
     * ====================================
     * @return array[
     *   'title'(string|null) ,
     *   'status'(boolean|null)
     */
    public function checkCodeOff(Request $request){
        if ($request->has("cookie") && $request->has("codeOff")){

            $orderTotalPrice=$this->getTotalPriceOrder($request->cookie);

            $resultCheck =  ContextRepository::CodeOffRepository()->CheckCodeOff($request->codeOff,$orderTotalPrice);

            return [
                "title" => $resultCheck["title"] ,
                "status" => $resultCheck["status"] ,
            ];
        }

        return abort(404);
    }






    /* @method POST
     * ====================================
     * @url /order/payment/submit-request-payment
     *====================================
     * @param string $cookie (Request)
     * @param string $codeOff (Request)
     * @param string $className (Request)
     * ====================================
     * @return array[
     *   'title'(string|null) ,
     *   'status'(boolean|null) ,
     *   'url'(string|null) ,
     */
    public function submitRequestPayment(Request $request){

        if ($request->has("className") && $request->has("cookie")){
            $resultExp = [
                "title"=>"" ,
                "status"=> false ,
                "url"=>"" ,
                "gotoPanel" => false
            ];

            $codeOff = null;
            if ($request->has("codeOff")){
                $codeOff = $request->get("codeOff");
            }

            if (ContextRepository::BankRepository()->CheckExistBank($request->className)){
                $user = ContextRepository::UserRepository()->GetUserAuthInfo();

                if ($user != null && !empty($user)){

                    if ($user->cart_number !="" || $user->cart_number != null){

                        $infoBasket=$this->getBasketsAndInfoPrice($request->cookie);
                        /**@var IModelBaseList $listBasket*/
                        $listBasket = $infoBasket["listBasket"];
                        /**@var ModelInfoPriceBasket $infoPrice*/
                        $infoPrice = $infoBasket["infoPrice"];

                        $isEmptyBasket = $infoPrice->isEmptyBasket();
                        $orderTotalPrice = $infoPrice->getTotalPrice();

                        if (!$isEmptyBasket){

                            $resultOrder = ContextRepository::OrderRepository()->SetOrderForCookieBaskets($listBasket->getCollect() , $infoPrice , $codeOff );


                            if ($resultOrder->getPriceForPayment() > 0){
                                if ($resultOrder->isReadyForPayment() && $resultOrder->getOrderId()!=null && $resultOrder->getOrderId()>0){

                                    $banksService = ContextServiceRepository::PaymentService()->createRequestPayment(
                                        $request->className , $resultOrder , $user
                                    );


                                    $resultExp["title"]= $banksService->getMsg();
                                    $resultExp["status"]= $banksService->getStatus();
                                    $resultExp["url"]= $banksService->getRedirect();
                                }
                                else{
                                    $resultExp["status"] = false;
                                    $resultExp["title"] = "مشکلی در هنگام پردازش سفارش رخ داده است، لطفا دوباره تلاش نمایید ...";
                                }
                            }
                        }
                        else{
                            $resultExp["status"] = false;
                            $resultExp["title"] = "سبد خرید شما خالی می باشد";
                        }
                    }
                    else{
                        $resultExp["gotoPanel"] = true;
                    }
                }
                else{
                    $resultExp["status"] = false;
                    $resultExp["title"] = "برای ثبت سفارش باید وارد حساب کاربری خود شوید";
                }
            }

            return $resultExp;
        }

        return abort(404);
    }







    /* @method POST
     * ====================================
     * @url /order/result/result-payment
     *====================================
     * @param string $resNum (Request)
     * ====================================
    /**@param string $cookie
     * @return array[
     *   'is_status'(boolean) ,
     *   'order_id'(int) ,
     *   'bank_name'(string) ,
     *   'description'(string) ,
     *   'mobile'(string) ,
     *   'email'(string) ,
     *   'res_num'(string) ,
     *   'ref_num'(string) ,
     *   'amount'(string) ,
     *   'message'(string) ,
     * ]
     */
    public function resultPayment(Request $request){
        if ($request->has("serviceName") && $request->has("dataPayment")){

            $serviceName = $request->serviceName;
            $dataPayment = json_decode($request->dataPayment, true);

            $resultData = ContextRepository::BankPaymentRepository()->setResultVerifyDataPayment($serviceName , $dataPayment);

            $infoPrice = $resultData->getInfoPrice()->toArray();
            $infoPayment = $resultData->getInfoPayment()->toArray();

            /**@var IModelBaseList<ModelBasket> $CollectBasket  */
            $CollectBasket = $resultData->getListBasket()->getCollect();
            $listBasket = [];
            /**@var ModelBasket $itemBasket*/
            foreach ($CollectBasket as $itemBasket){
                array_push( $listBasket, $itemBasket->toArray());
            }

            $codeOff = $resultData->getCodeOff();
            $codeOffPrice = $resultData->getCodeOffPrice();
            $codeOffPricePass = $resultData->getCodeOffPriceTextPass();

            return compact( "request",
                "listBasket" , "infoPrice" , "infoPayment" ,
                "codeOff" , "codeOffPrice" ,"codeOffPricePass"
            );

        }

        return abort(404);
    }

}
