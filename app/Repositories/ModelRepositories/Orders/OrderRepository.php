<?php
namespace App\Repositories\ModelRepositories\Orders;

use App\Http\Services\ContextService\Payment\BaseService\Models\ResultVerifyPaymentModel;
use App\Http\Services\onTimeService\Basket\BaseBasket;
use App\Http\Services\onTimeService\Basket\ModelInfoPriceBasket;
use App\Models\Orders\Order;
use App\Repositories\ContextRepository;
use App\Repositories\InterFaceRepositories\Orders\IOrderRepository;
use App\Repositories\ModelRepositories\BaseRepository;
use App\Tools\Models\IModelBaseList;
use App\Tools\Models\ModelBaseList;
use App\Tools\Models\Repositories\Banks\ModelVerifyBankPayment;
use App\Tools\Models\Repositories\Orders\ModelCheckCodeOffForPayment;
use App\Tools\Models\Repositories\Orders\ModelOrderPayment;
use App\Tools\Models\Repositories\Orders\ModelUserInfoForPayment;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

/**
 * @template-extends BaseRepository<Order>
 * @template-implements  IOrderRepository<Order>
 */
class OrderRepository extends BaseRepository implements IOrderRepository {

    protected $periodOrderWithoutBaskets = 7;


    public function __construct()
    {
        parent::__construct(new Order());
    }

    //---------------------------------------------------
    /**
     * @inheritDoc
     */
    function SetOrderForCookieBaskets($listBasket, ModelInfoPriceBasket $infoPrice, $codeOff = null) :ModelOrderPayment
    {
        /// Check Code off
        $resultCheckCodeOff = $this->checkCodeOff($infoPrice , $codeOff);
        $codeOff = $resultCheckCodeOff->getCodeOff();
        $codeOffPrice = $resultCheckCodeOff->getCodeOffPrice();

        $modelOrderPayment = new ModelOrderPayment();
        $modelOrderPayment->setPriceForPayment($this->getPriceForPaymentToRial($infoPrice , $codeOffPrice));
        $modelOrderPayment->setPaymentDescription("پرداخت سبد خرید");



        $userInfo= ContextRepository::UserRepository()->GetUserAuthInfo();
        $modelUserInfoForPayment = new ModelUserInfoForPayment();
        $modelUserInfoForPayment->setUserId($userInfo->id);
        $modelUserInfoForPayment->setUserFullName($userInfo->fullName);
        $modelUserInfoForPayment->setUserMobile($userInfo->mobile);
        $modelUserInfoForPayment->setUserEmail($userInfo->email);
        $modelOrderPayment->setUserInfo($modelUserInfoForPayment);


        /// Order and Basket
        /**@var Order $order*/
        $order = $this->getOrderFromListBasket($listBasket , $modelUserInfoForPayment);
        if (!empty($order) && $order!=null){
            $modelOrderPayment->setOrderId($order->id);
            $modelOrderPayment->setOrderId($order->res_num);
            $this->updateInfoOrderForPayment($modelOrderPayment->getOrderId() , $infoPrice , $codeOff , $codeOffPrice , $modelUserInfoForPayment);
            $modelOrderPayment->setReadyForPayment(true);
        }
        else{
            $order = $this->addOrderForPayment($infoPrice , $codeOff , $codeOffPrice , $modelUserInfoForPayment);
            $modelOrderPayment->setOrderId($order->id);
            $modelOrderPayment->setResNum($order->res_num);
            $modelOrderPayment->setReadyForPayment(true);
        }

        if ($modelOrderPayment->isReadyForPayment() && $modelOrderPayment->getOrderId()!=null && $modelOrderPayment->getOrderId()>0){

            /// update order baskets
            foreach ($listBasket as $itemOrder){
                ContextRepository::OrderBasketRepository()->updateFinishDataBasket($itemOrder , $modelOrderPayment->getOrderId());
            }
        }

        return $modelOrderPayment;
    }

    /**
     * @inheritDoc
     */
    function SetFinishOrder($orderId , $descriptionFinish , $userId=0)
    {
        if ($userId > 0){
            $this->model= $this->model->where("user_id" , $userId);
        }
        else{
            $this->model= $this->model->where("user_id" , ContextRepository::UserRepository()->GetUserAuthId());
        }


        return
            $this->model
                ->where("id" , $orderId)
                ->update([
                    "is_finish" => true ,
                    "description_finish" => $descriptionFinish
                ]);
    }

    /**
     * @inheritDoc
     */
    function GetOrderAndBaskets($orderId , $userId=0)
    {
        if ($userId > 0){
            $this->model= $this->model->where("user_id" , $userId);
        }
        else{
            $this->model= $this->model->where("user_id" , ContextRepository::UserRepository()->GetUserAuthId());
        }

        return $this->model
            ->where("id" , $orderId)
            ->with("orderBaskets")
            ->first();
    }



    //----------------------------------------------------
    //panel_client_order
    //----------------------------------------------------

    /**
     * @inheritDoc
     */
    function GetListOrdersUser($resNum = "" , $isFinish=null)
    {
        if ($resNum != ""){
            $this->model = $this->addSearcher('res_num' , $resNum);
        }

        if ($isFinish != null && in_array($isFinish , [0 , 1])){
            $this->model = $this->model->where('is_finish' , $isFinish);
        }

        return $this->model
            ->with("orderBaskets")
            ->where("user_id" , ContextRepository::UserRepository()->GetUserAuthId())
            ->orderBy("id" , "desc")
            ->get();
    }

    /**
     * @inheritDoc
     */
    function GetInfoOrderUser($resNum , $fullInfoPayment=false) :ModelVerifyBankPayment|null
    {
        /**@var Order $result*/
        $result = $this->model
            ->with(["bankPayments" , "orderBaskets"])
            ->where("user_id" , ContextRepository::UserRepository()->GetUserAuthId())
            ->where("res_num" , $resNum)
            ->first();

        if (!empty($result) && $result!=null){
            return $this->getModelVerifyBankPaymentFromOrder($result , $fullInfoPayment);
        }
        return null;
    }




    //----------------------------------------------------
    //Admin
    //----------------------------------------------------

    /**
     * @inheritDoc
     */
    function getListOrders($userSearch = "", $resNumSearch = "", $isFinishSearch = -1, $numInPage = 15)
    {
        if ($userSearch != ""){
            $this->model = $this->model->join('users', function($join) use ($userSearch){

                $join->on('orders.user_id', "=", 'users.id');

                $join
                    ->where(DB::raw("CONCAT(users.`name`, ' ', users.`family`)")  , "like" , $userSearch."%")
                    ->orWhere(DB::raw("CONCAT(users.`name`, ' ', users.`family`)")  , "like" , "%".$userSearch)
                    ->orWhere(DB::raw("CONCAT(users.`name`, ' ', users.`family`)")  , "like" , "%".$userSearch."%")
                    ->orWhere(DB::raw("CONCAT(users.`name`, ' ', users.`family`)")  , "like" , $userSearch);
            });
        }

        if ($resNumSearch != ""){
            $this->model = $this->addSearcher("res_num" , $resNumSearch);
        }

        if (in_array($isFinishSearch , [0 , 1])){
            $this->model = $this->model->where("is_finish" , $isFinishSearch);
        }

        return $this->model->paginate($numInPage);
    }


    /**
     * @inheritDoc
     */
    function getInfoOrder($orderID): ModelVerifyBankPayment
    {
        /**@var Order $result*/
        $result = $this->model
            ->with(["bankPayments" , "orderBaskets"])
            ->where("id" , $orderID)
            ->first();

        return $this->getModelVerifyBankPaymentFromOrder($result , true);
    }


    /**
     * @inheritDoc
     */
    function setStateFinishOrder(Order $order, $descriptionFinish = "", $isFinish = 0)
    {
        return $order->update([
            "description_finish" =>$descriptionFinish ,
            "is_finish" =>$isFinish ,
        ]);
    }





    //---------------------------------------------------
    // Methods
    //---------------------------------------------------

    /**
     * @return  ModelCheckCodeOffForPayment
     */
    private function checkCodeOff(ModelInfoPriceBasket $infoPrice , $codeOff = null) :ModelCheckCodeOffForPayment
    {
        $modelCheckCodeOffForPayment = new ModelCheckCodeOffForPayment();

        if ($codeOff != null){
            $orderInfoPrice = $this->getOrderInfoPrice($infoPrice);
            $orderTotalPrice = $orderInfoPrice["orderTotalPrice"];
            $resultCheck =  ContextRepository::CodeOffRepository()->CheckCodeOff($codeOff,$orderTotalPrice);
            if ($resultCheck["status"]){
                $modelCheckCodeOffForPayment->setCodeOff($codeOff);
                $modelCheckCodeOffForPayment->setCodeOffPrice($resultCheck["off"]);
            }
        }

        return $modelCheckCodeOffForPayment;
    }

    /**
     * @return  bool
     */
    private function updateInfoOrderForPayment($orderId ,ModelInfoPriceBasket $infoPrice , $codeOff = null, $codeOffPrice = 0  , ModelUserInfoForPayment $modelUserInfoForPayment){
        $orderInfoPrice = $this->getOrderInfoPrice($infoPrice);
        $orderRealPrice = $orderInfoPrice["orderRealPrice"];
        $orderOffPrice = $orderInfoPrice["orderOffPrice"];
        $orderTotalPrice = $orderInfoPrice["orderTotalPrice"];

        return
            $this->model
            ->where("id" , $orderId)
            ->where("user_id" , $modelUserInfoForPayment->getUserId())
            ->update([
                "code_off" => $codeOff ,
                "code_price" => $codeOffPrice ,
                "real_price" => $orderRealPrice ,
                "off_price" => $orderOffPrice ,
                "total_Price" => $orderTotalPrice
            ]);
    }

    /**
     * @return  Order
     */
    private function addOrderForPayment(ModelInfoPriceBasket $infoPrice , $codeOff = null, $codeOffPrice = 0 , ModelUserInfoForPayment $modelUserInfoForPayment){
        $orderInfoPrice = $this->getOrderInfoPrice($infoPrice);
        $orderRealPrice = $orderInfoPrice["orderRealPrice"];
        $orderOffPrice = $orderInfoPrice["orderOffPrice"];
        $orderTotalPrice = $orderInfoPrice["orderTotalPrice"];

        return
            $this->model->create([
                    "res_num" => time() ,
                    "code_off" => $codeOff ,
                    "code_price" => $codeOffPrice ,
                    "real_price" => $orderRealPrice ,
                    "off_price" => $orderOffPrice ,
                    "total_Price" => $orderTotalPrice ,
                    "user_id" => $modelUserInfoForPayment->getUserId() ,
                ]);
    }

    /**
     * @return  int|null
     */
    private function getPriceForPaymentToRial(ModelInfoPriceBasket $infoPrice , $codeOffPrice = 0){
        $orderInfoPrice = $this->getOrderInfoPrice($infoPrice);
        $orderTotalPrice = $orderInfoPrice["orderTotalPrice"];

        return ($orderTotalPrice - $codeOffPrice)*10;
    }

    /**
     * @return  array
     */
    private function getOrderInfoPrice(ModelInfoPriceBasket $infoPrice){
        return[
            "orderRealPrice" => $infoPrice->getRealPrice() ,
            "orderOffPrice" => $infoPrice->getOffPrice() ,
            "orderTotalPrice" => $infoPrice->getTotalPrice() ,
        ];
    }

    /**
     * @return  Order
     */
    private function getOrderFromListBasket($listBasket , ModelUserInfoForPayment $modelUserInfoForPayment){
        $order=null;
        $orderId=null;
        foreach ($listBasket as $item){
            $itemOrderId = $item->getItemOrderId();
            if ($itemOrderId != null){
                $orderId = $itemOrderId;
                break;
            }
        }

        if ($orderId!= null && $orderId>0){
            $order =
                $this->model
                    ->where("id" , $orderId)
                    ->where("id" , $modelUserInfoForPayment->getUserId() )
                    ->first();
        }

        return $order;
    }


    private function getModelVerifyBankPaymentFromOrder(Order $order , $fullInfoPayment = false) :ModelVerifyBankPayment
    {
        $modelVerifyBankPayment = new ModelVerifyBankPayment();

        if (!empty($order) && $order !=null){
            $modelVerifyBankPayment->setExistRecord(true);
            $modelVerifyBankPayment->setOrderResNum($order->res_num);

            $baseBasket = new BaseBasket();
            $resultBasket = $baseBasket->getListModelBasket($order->orderBaskets , false);
            //$modelVerifyBankPayment->setListBasket($resultBasket->getListBasket()->getCollectBasket());
            $modelVerifyBankPayment->setListBasket($resultBasket->getListBasket());
            $modelVerifyBankPayment->setInfoPrice($resultBasket->getInfoPrice());

            $modelVerifyBankPayment->setCodeOff($order->code_off);
            $modelVerifyBankPayment->setCodeOffPrice($order->code_price);

            if (isset($order->bankPayments)){

                /**@var IModelBaseList<ResultVerifyPaymentModel> $userCollection  */
                $userCollection = new ModelBaseList(ResultVerifyPaymentModel::class);

                foreach ($order->bankPayments as $itemPayment){
                    $payment = ContextRepository::BankPaymentRepository()->GetModelResultPaymentFromPayment($itemPayment , $fullInfoPayment);
                    $userCollection->add($payment);
                    if ($payment->getStatusPayment()){
                        $modelVerifyBankPayment->setExistSuccessPayment(true);
                        $modelVerifyBankPayment->setInfoPayment($payment);
                    }
                }

                $modelVerifyBankPayment->setListPayment($userCollection);
            }

            if ($fullInfoPayment){
                $modelVerifyBankPayment->setOrder($order);
                $modelVerifyBankPayment->setUserId($order->user_id);
                $modelVerifyBankPayment->setUserFullName($order->user->full_name);
            }
        }

        return $modelVerifyBankPayment;
    }


    //---------------------------------------------------


    /**
     * @inheritDoc
     */
    function deleteOrdersWithoutBaskets()
    {
        $orders = $this->model
            ->where("created_at" , ">=" , Carbon::now()->subDays($this->periodOrderWithoutBaskets)->toDateTimeString())
            ->with("orderBaskets")
            ->get();


        foreach ($orders as $itemOrder){
            $baskets = $itemOrder->orderBaskets;
            if (sizeof($baskets) == 0){
                $itemOrder->delete();
            }
        }

        return true;
    }
}
