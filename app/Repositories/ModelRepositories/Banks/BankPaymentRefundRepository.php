<?php
namespace App\Repositories\ModelRepositories\Banks;

use App\Http\Services\Banks\BanksService\BanksService;
use App\Http\Services\Banks\BanksService\Models\ModelResultPayment;
use App\Models\Banks\BankPayment;
use App\Models\Banks\BankPaymentRefund;
use App\Repositories\InterFaceRepositories\Banks\IBankPaymentRefundRepository;
use App\Repositories\InterFaceRepositories\Banks\IBankPaymentRepository;
use App\Repositories\ModelRepositories\BaseRepository;
use App\Tools\Models\Repositories\Banks\ModelPublicBankPayment;
use App\Tools\Models\Repositories\Banks\ModelVerifyBankPayment;
use Illuminate\Support\Facades\DB;

/**
 * @template-extends BaseRepository<BankPaymentRefund>
 * @template-implements  IBankPaymentRepository<BankPaymentRefund>
 */
class BankPaymentRefundRepository extends BaseRepository implements IBankPaymentRefundRepository {

    public function __construct()
    {
        parent::__construct(new BankPaymentRefund());
    }


    /**
     * @inheritDoc
     */
    function AddBankPaymentRefundSuccess($code, $message, $resNum, $refNum, $extraData, BankPayment $bankPayment , $status)
    {
        foreach ($bankPayment->extra_data as $key => $itemExtra){
            $extraData[$key] = $itemExtra;
        }

        return $this->addResult([
            "code" => $code ,
            "message" => $message ,
            "res_num" => time() ,
            "authority_num" => $resNum ,
            "mobile" => $bankPayment->mobile ,
            "email" => $bankPayment->email ,
            "amount" => $bankPayment->amount ,
            "description" => $bankPayment->description ,
            "payment_class_name" => $bankPayment->payment_class_name ,
            "user_id" => $bankPayment->user_id ,
            "bank_payment_id" => $bankPayment->id ,
            "order_id" => $bankPayment->order_id ,
            "ref_num" => $refNum ,
            "extra_data" => $extraData ,
            "status" => $status ,
        ]);
    }


    //---------------------------------------------------------


    /**
     * @inheritDoc
     */
    function GetListBankPaymentRefunds($resSearch = "", $refSearch = "", $authoritySearch = "", $bankSearch = "", $userSearch = "", $resOrderSearch = "", $statusSearch = -1, $numInPage = 15)
    {
        if ($resSearch != ""){
            $this->model = $this->addSearcher("Res_num" , $resSearch);
        }

        if ($refSearch != ""){
            $this->model = $this->addSearcher("ref_num" , $resSearch);
        }

        if ($authoritySearch != ""){
            $this->model = $this->addSearcher("authority_num" , $authoritySearch);
        }

        if ($bankSearch != ""){
            $this->model = $this->model->where("payment_class_name" , $bankSearch);
        }

        if ($userSearch != ""){
            $this->model = $this->model->join('users', function($join) use ($userSearch){
                $join->on(' bank_payment_refunds.user_id', "=", 'users.id');

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
                $join->on('bank_payment_refunds.order_id', "=", 'orders.id');

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
