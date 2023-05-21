<?php
namespace App\Repositories\ModelRepositories\Banks;

use App\Http\Services\Banks\BanksService\BanksService;
use App\Http\Services\Banks\BanksService\Models\ModelResultPayment;
use App\Models\Banks\BankPayment;
use App\Models\Banks\BankPaymentUnVerify;
use App\Repositories\InterFaceRepositories\Banks\IBankPaymentRepository;
use App\Repositories\InterFaceRepositories\Banks\IBankPaymentUnVerifyRepository;
use App\Repositories\ModelRepositories\BaseRepository;
use App\Tools\Models\Repositories\Banks\ModelPublicBankPayment;
use App\Tools\Models\Repositories\Banks\ModelVerifyBankPayment;
use Illuminate\Support\Facades\DB;

/**
 * @template-extends BaseRepository<BankPayment>
 * @template-implements  IBankPaymentRepository<BankPayment>
 */
class BankPaymentUnVerifyRepository extends BaseRepository implements IBankPaymentUnVerifyRepository {

    public function __construct()
    {
        parent::__construct(new BankPaymentUnVerify());
    }



    /**
     * @inheritDoc
     */
    function AddBankPaymentUnVerifiedNotFound($authority, $amount, $dateSubmit, array $extraData, $paymentClassName)
    {
        return $this->addResult([
            "authority_num" => $authority ,
            "extra_data" => $extraData ,
            "amount" => $amount ,
            "date_submit" => $dateSubmit ,
            "payment_class_name" => $paymentClassName
        ]);
    }


    /**
     * @inheritDoc
     */
    function AddBankPaymentUnVerifiedSuccess(BankPayment $bankPayment ,$authority, $amount, $dateSubmit, array $extraData , $paymentClassName)
    {
        return $this->addResult([
            "authority_num" => $authority ,
            "extra_data" => $extraData ,
            "amount" => $amount ,
            "date_submit" => $dateSubmit ,
            "payment_class_name" => $paymentClassName ,
            "user_id" => $bankPayment->user_id ,
            "bank_payment_id" => $bankPayment->id ,
            "order_id" => $bankPayment->order_id ,
            "status" => 1
        ]);

    }


    //-----------------------------------------------------

    /**
     * @inheritDoc
     */
    function GetListBankPaymentUnVerifies($resSearch = "",  $bankSearch = "", $userSearch = "", $resOrderSearch = "", $statusSearch = -1, $numInPage = 15)
    {
        if ($resSearch != ""){
            $this->model = $this->addSearcher("authority_num" , $resSearch);
        }

        if ($bankSearch != ""){
            $this->model = $this->model->where("payment_class_name" , $bankSearch);
        }

        if ($userSearch != ""){
            $this->model = $this->model->join('users', function($join) use ($userSearch){
                $join->on('bank_payment_un_verifies.user_id', "=", 'users.id');

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
                $join->on('bank_payment_un_verifies.order_id', "=", 'orders.id');

                $join->where(function($where) use ($resOrderSearch){
                    $where->orWhere("orders.res_num"  , "like" , $resOrderSearch."%")
                        ->orWhere("orders.res_num"  , "like" , "%".$resOrderSearch)
                        ->orWhere("orders.res_num" , "like" , "%".$resOrderSearch."%")
                        ->orWhere("orders.res_num"  , "like" , $resOrderSearch);
                });

            });
        }

        if (in_array($statusSearch , [0 , 1])){
            $this->model = $this->model->where("status" , $statusSearch);
        }


        return $this->model->orderBy("id" , "desc")->paginate($numInPage);
    }





}
