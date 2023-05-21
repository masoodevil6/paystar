<?php
namespace App\Repositories\ModelRepositories\Banks;

use App\Http\Services\Banks\BanksService\BanksService;
use App\Http\Services\Banks\BanksService\Models\ModelResultPayment;
use App\Http\Services\ContextService\ContextServiceRepository;
use App\Http\Services\ContextService\Payment\BaseService\Models\ResultVerifyPaymentModel;
use App\Http\Services\onTimeService\Basket\BaseBasket;
use App\Http\Services\onTimeService\Basket\ModelBasket;
use App\Models\Banks\BankPayment;
use App\Models\Subscribes\Subscribe;
use App\Repositories\ContextRepository;
use App\Repositories\InterFaceRepositories\Banks\IBankPaymentRepository;
use App\Repositories\ModelRepositories\BaseRepository;
use App\Tools\Models\Repositories\Banks\ModelPublicBankPayment;
use App\Tools\Models\Repositories\Banks\ModelVerifyBankPayment;
use Illuminate\Support\Facades\DB;

/**
 * @template-extends BaseRepository<BankPayment>
 * @template-implements  IBankPaymentRepository<BankPayment>
 */
class BankPaymentRepository extends BaseRepository implements IBankPaymentRepository {

    public function __construct()
    {
        parent::__construct(new BankPayment());
    }

    /**
     * @inheritDoc
     */
    function addSubmitRequest(
        $payment_class_name,
        $is_test , $orderId , $user_id,
        $resNum, $authorityNum,
        $amount, $description,
        $mobile, $email)
    {
        return $this->addResult([
            "payment_class_name" => $payment_class_name,
            "is_test" => $is_test,
            "order_id" => $orderId,
            "user_id" => $user_id,
            "Res_num" => $resNum ,
            "authority_num" => $authorityNum ,
            "amount" => $amount ,
            "description" => $description ,
            "mobile" => $mobile ,
            "email" => $email ,
        ]);
    }

    /**
     * @inheritDoc
     */
    function addSubmitRequestWithRefNum(
        $service_name,
        $is_test , $orderId , $user_id,
        $resNum , $refNum , $authorityNum,
        $amount, $description,
        $mobile, $email)
    {
        return $this->addResult([
            "service_name" => $service_name,
            "is_test" => $is_test,
            "order_id" => $orderId,
            "user_id" => $user_id,
            "Res_num" => $resNum ,
            "ref_num" => $refNum ,
            "authority_num" => $authorityNum ,
            "amount" => $amount ,
            "description" => $description ,
            "mobile" => $mobile ,
            "email" => $email ,
        ]);
    }


    /**
     * @inheritDoc
     */
    function setCancelPayment($authorityNum, $message)
    {
        return $this->model
            ->where("authority_num" , $authorityNum)
            ->where("user_id" , ContextRepository::UserRepository()->GetUserAuthId())
            ->where("active" , 1)
            ->update([
                "active" => 0 ,
                "message" => $message
            ]);
    }

    /**
     * @inheritDoc
     */
    function setSuspensionPaymentFromAuthorityNum($authorityNum, $message , $thisClient=true)
    {
        if ($thisClient){
            $this->model = $this->model->where("user_id" , ContextRepository::UserRepository()->GetUserAuthId());
        }

        return $this->model
            ->where("authority_num" , $authorityNum)
            ->where("active" , 1)
            ->update([
                "message" => $message
            ]);
    }

    /**
     * @inheritDoc
     */
    function setFailedPaymentFromAuthorityNum($authorityNum , $code, $codeMessage , $thisClient=true)
    {
        if ($thisClient){
            $this->model = $this->model->where("user_id" , ContextRepository::UserRepository()->GetUserAuthId());
        }

        return $this->model
            ->where("authority_num" , $authorityNum)
            ->where("active" , 1)
            ->update([
                "active" => 0 ,
                "code" => $code ,
                "message" => $codeMessage
            ]);
    }




    /**
     * @inheritDoc
     */
    function getPaymentDataAuthorityNum($authorityNum , $thisClient=true)
    {
        if ($thisClient){
            $this->model = $this->model->where("user_id" , ContextRepository::UserRepository()->GetUserAuthId());
        }

        return $this->model
            ->where("authority_num" , $authorityNum)
            ->first();
    }


    /**
     * @inheritDoc
     */
    function getPaymentDataResNum($resNum , $thisClient=true)
    {
        if ($thisClient){
            $this->model = $this->model->where("user_id" , ContextRepository::UserRepository()->GetUserAuthId());
        }

        return $this->model
            ->where("Res_num" , $resNum)
            ->first();
    }
    /**
     * @inheritDoc
     */
    function getPaymentDataResNumAndRefNum($resNum , $refNum)
    {
        return $this->model
            ->where("ref_num" , $refNum)
            ->where("Res_num" , $resNum)
            ->where("user_id" , ContextRepository::UserRepository()->GetUserAuthId())
            ->first();
    }

    /**
     * @inheritDoc
     */
    function setVerifyDataPayment($code, $codeMessage, $refId, $extraData, $authorityNum, $thisClient=true)
    {
        if ($thisClient){
            $this->model = $this->model->where("user_id" , ContextRepository::UserRepository()->GetUserAuthId());
        }

        return $this->model
            ->where("authority_num" , $authorityNum)
            ->where("active" , 1)
            ->update([
                "code" => $code ,
                "message" => $codeMessage ,
                "ref_num" => $refId ,
                "extra_data" => $extraData ,
                "active" => 0 ,
                "is_status" => true ,
            ]);
    }


    /**
     * @inheritDoc
     */
    function setResultVerifyDataPayment($bankName, $dataResult , $userId=0) :ModelVerifyBankPayment
    {
        $modelVerifyBankPayment = new ModelVerifyBankPayment();

        $resultPayment = ContextServiceRepository::PaymentService()->verifyRequestPayment(
            $bankName , $dataResult , ContextRepository::UserRepository()->GetUserAuthInfo()
        );

        $modelVerifyBankPayment->setInfoPayment($resultPayment);

        if ($resultPayment->getOrderId() != null){

            $order = ContextRepository::OrderRepository()->GetOrderAndBaskets($resultPayment->getOrderId() , $userId);

            if (!empty($order) && $order!= null){
                ContextRepository::OrderRepository()->SetFinishOrder($resultPayment->getOrderId() , $resultPayment->getMessage() , $userId);

                $baseBasket = new BaseBasket();
                $resultBasket = $baseBasket->getListModelBasket($order->orderBaskets , false);
                $listBasket = $resultBasket->getListBasket();
                $infoPrice = $resultBasket->getInfoPrice();
                $modelVerifyBankPayment->setListBasket($listBasket);
                $modelVerifyBankPayment->setInfoPrice($infoPrice);


                $codeOff=$order->code_off;
                $codeOffPrice=$order->code_price;
                $modelVerifyBankPayment->setCodeOff($codeOff);
                $modelVerifyBankPayment->setCodeOffPrice($codeOffPrice);

                if ($resultPayment->isStatusPayment()){

                    if (!empty($codeOff) && $codeOff != null && $codeOffPrice>0){
                        ContextRepository::CodeOffRepository()->setUsedCodeOff($codeOff);
                    }

                    $modelPublicBankPayment = new ModelPublicBankPayment();
                    $modelPublicBankPayment->setBankName($bankName);
                    $modelPublicBankPayment->setAmount($resultPayment->getIntAmount());
                    $modelPublicBankPayment->setResNum($resultPayment->getResNum());
                    $modelPublicBankPayment->setRefNum($resultPayment->getRefNum());
                    $modelPublicBankPayment->setEmail($resultPayment->getEmail());
                    $modelPublicBankPayment->setPhone($resultPayment->getPhone());


                    for ($i=0; $i<$listBasket->getSize(); $i++){
                        /**@var ModelBasket $itemBasket*/
                        $itemBasket=$listBasket->get($i);

                        $submitted = $itemBasket->isSubmitted();
                        if ($itemBasket->getItemOrderBasketableType() == Subscribe::class && !$submitted){
                            $submitted = ContextRepository::SubscribePaymentRepository()->AddSubscribePaymentFromPayment($itemBasket->getItemOrderBasketableId() , $modelPublicBankPayment , $userId);
                        }

                        if ($submitted && !empty($itemBasket->getItemCookie()) && $itemBasket->getItemCookie()!=null){
                            ContextRepository::OrderBasketRepository()->setBasketFinishWidthDeleteCookie($itemBasket->getItemId() , $submitted);
                        }
                    }
                }
            }
        }

        return $modelVerifyBankPayment;
    }




    /**
     * @inheritDoc
     */
    function GetModelResultPaymentFromPayment(BankPayment $bankPayment ,$fullRecord=false): ResultVerifyPaymentModel
    {
        $modelResultPayment = new ResultVerifyPaymentModel;

        $modelResultPayment->setCode($bankPayment->code);
        $modelResultPayment->setMessage($bankPayment->message);
        $modelResultPayment->setResNum($bankPayment->Res_num);
        $modelResultPayment->setRefNum($bankPayment->ref_num);
        $modelResultPayment->setAmount($bankPayment->amount);
        $modelResultPayment->setDescription($bankPayment->description );
        $modelResultPayment->setDescription($bankPayment->description );
        $modelResultPayment->setStatusPayment($bankPayment->is_status);
        $modelResultPayment->setPaymentName($bankPayment->service_name);

        if ($fullRecord){
            $modelResultPayment->setPhone($bankPayment->mobile);
            $modelResultPayment->setEmail($bankPayment->email);
            $modelResultPayment->setOrderId($bankPayment->order_id );
        }

        return $modelResultPayment;
    }

    //------------------------------------------------------

    /**
     * @inheritDoc
     */
    function GetListBankPayments($resSearch = "", $refSearch = "", $bankSearch = "", $userSearch = "", $resOrderSearch = "", $testSearch = -1, $statusSearch = -1, $numInPage = 15)
    {
        if ($resSearch != ""){
            $this->model = $this->addSearcher("Res_num" , $resSearch);
        }

        if ($refSearch != ""){
            $this->model = $this->addSearcher("ref_num" , $resSearch);
        }

        if ($bankSearch != ""){
            $this->model = $this->model->where("payment_class_name" , $bankSearch);
        }

        if ($userSearch != ""){
            $this->model = $this->model->join('users', function($join) use ($userSearch){
                $join->on('bank_payments.user_id', "=", 'users.id');

                $join->where(function($where) use ($userSearch){
                    $where->orWhere(DB::raw("CONCAT(users.`name`, ' ', users.`family`)")  , "like" , $userSearch."%")
                        ->orWhere(DB::raw("CONCAT(users.`name`, ' ', users.`family`)")  , "like" , "%".$userSearch)
                        ->orWhere(DB::raw("CONCAT(users.`name`, ' ', users.`family`)")  , "like" , "%".$userSearch."%")
                        ->orWhere(DB::raw("CONCAT(users.`name`, ' ', users.`family`)")  , "like" , $userSearch);
                });

            });
        }

        if ($resOrderSearch != ""){
            $this->model = $this->model->join('orders', function($join) use ($resOrderSearch){
                $join->on('bank_payments.order_id', "=", 'orders.id');

                $join->where(function($where) use ($resOrderSearch){
                    $where->orWhere("orders.res_num"  , "like" , $resOrderSearch."%")
                        ->orWhere("orders.res_num"  , "like" , "%".$resOrderSearch)
                        ->orWhere("orders.res_num" , "like" , "%".$resOrderSearch."%")
                        ->orWhere("orders.res_num"  , "like" , $resOrderSearch);
                });

            });
        }

        if (in_array($testSearch , [0 , 1])){
            $this->model = $this->model->where("is_test" , $testSearch);
        }

        if (in_array($statusSearch , [0 , 1])){
            $this->model = $this->model->where("is_status" , $statusSearch);
        }

        return $this->model->orderBy("id" , "desc")->paginate($numInPage);
    }


    /**
     * @inheritDoc
     */
    function SubmitAdminTextBankPayment(BankPayment $bankPayment, $status, $textAdmin)
    {
        return $bankPayment->update([
            "text_admin" =>$textAdmin ,
            "is_status" =>$status ,
        ]);
    }


}
