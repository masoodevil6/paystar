<?php

namespace App\Http\Controllers\Admin\Banks;

use App\Http\Controllers\Admin\MainAdminController;
use App\Http\Requests\Admin\Bank\BankPaymentRequest;
use App\Http\Requests\Admin\Bank\BankRequest;
use App\Http\Requests\Admin\Bank\TestPaymentRequest;
use App\Models\Banks\Bank;
use App\Models\Banks\BankPayment;
use App\Repositories\ContextRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;

class BankPaymentAdminController extends MainAdminController
{
    function __construct()
    {
        parent::__construct(route("admin.banks.payment.index") );
    }



    public function index(){
        $nav = [
            "part"=> "بخش مدیریت بانک ها",
            "navigation" =>[
                [
                    "route" => "" ,
                    "current" => 1,
                    "title" => "لیست تراکنش ها"
                ]
            ]
        ];

        $resSearch = "";
        if (isset($_GET["res_num"])){
            $resSearch = $_GET["res_num"];
        }
        $refSearch = "";
        if (isset($_GET["ref_num"])){
            $refSearch = $_GET["ref_num"];
        }
        $bankSearch = "";
        if (isset($_GET["bank"])){
            $bankSearch = $_GET["bank"];
        }
        $userSearch = "";
        if (isset($_GET["user"])){
            $userSearch = $_GET["user"];
        }
        $resOrderSearch = "";
        if (isset($_GET["res_num_order"])){
            $resOrderSearch = $_GET["res_num_order"];
        }
        $testSearch = -1;
        if (isset($_GET["is_test"])){
            $testSearch = $_GET["is_test"];
        }
        $statusSearch = -1;
        if (isset($_GET["is_status"])){
            $statusSearch = $_GET["is_status"];
        }

        $banks = ContextRepository::BankRepository()->getAllResult();
        $bankPayments = ContextRepository::BankPaymentRepository()->GetListBankPayments($resSearch , $refSearch , $bankSearch , $userSearch , $resOrderSearch , $testSearch , $statusSearch);

        return view(
            "admin.banks.payment.index" ,
            compact(
                "nav" , "bankPayments" , "banks" ,
                "resSearch" , "refSearch" , "bankSearch" , "userSearch" , "resOrderSearch" , "testSearch" , "statusSearch"
            )
        );
    }



    public function edit( $bankPaymentAuthorityNum){
        $bankPayment = ContextRepository::BankPaymentRepository()->getPaymentDataAuthorityNum($bankPaymentAuthorityNum , false);
        if (!empty($bankPayment) && $bankPayment!=null){
            /// navigation page
            $nav = [
                "part"=> "بخش مدیریت بانک ها",
                "navigation" =>[
                    [
                        "route" => "admin.Orders.order.index" ,
                        "current" => 0,
                        "title" => "لیست سفارشات"
                    ],
                    [
                        "route" => "" ,
                        "current" => 1,
                        "title" => "مشاهده/ویرایش سفارش"
                    ]
                ]
            ];

            return view("admin.banks.payment.edit" , compact("nav" , "bankPayment"));
        }
        else{
            return $this ->redirectIndex("تراکنش یافت نشد" , true);
        }
    }



    public function update(BankPaymentRequest $request, $bankPaymentAuthorityNum){
        $bankPayment = ContextRepository::BankPaymentRepository()->getPaymentDataAuthorityNum($bankPaymentAuthorityNum , false);
        if (!empty($bankPayment) && $bankPayment!=null){
            $input = $request->all();

            if (ContextRepository::BankPaymentRepository()->SubmitAdminTextBankPayment($bankPayment , $input["is_status"] , $input["text_admin"])){
                return $this ->redirectIndex("وضعیت تراکنش ، با موفقیت ویرایش شد");
            }
            else{
                return $this ->redirectIndex("مشکلی در ویرایش رخ داده است" , true);
            }
        }
        else{
            return $this ->redirectIndex("تراکنش یافت نشد" , true);
        }
    }


    public function submitVerify($bankPaymentAuthorityNum , SubmitVerifyPaymentService $submitVerifyPaymentService){
        $bankPayment = ContextRepository::BankPaymentRepository()->getPaymentDataAuthorityNum($bankPaymentAuthorityNum , false);
        if (!empty($bankPayment) && $bankPayment!=null){
            $resultPayment = $submitVerifyPaymentService->CheckVerifiedPayment($bankPayment , false);
            return $this ->redirectIndex(
                "[نتیجه]"."<br/>".
                "متن: ". $resultPayment->getInfoPayment()->getFullMessage() ."<br/>" .
                " نتیجه: ".$resultPayment->getInfoPayment()->getStatusPayment()
            );
        }
        else{
            return $this ->redirectIndex("مشکلی در وریقی تراکنش رخ داده است" , true);
        }
    }


    public function submitRefund($bankPaymentAuthorityNum , BanksService $banksService){
        $bankPayment = ContextRepository::BankPaymentRepository()->getPaymentDataAuthorityNum($bankPaymentAuthorityNum , false);
        if (!empty($bankPayment) && $bankPayment!=null){
            $resultRefund = $banksService->SubmitRefundPayment($bankPayment->payment_class_name , $bankPayment);
            return $this ->redirectIndex(
                "[نتیجه]"."<br/>".
                "متن: ". $resultRefund->getMessage() ."<br/>" .
                " شماره رزرو تراکنش: ".$resultRefund->getBankPaymentRefund()->res_num."<br/>" .
                " شماره تراکنش: ".$resultRefund->getBankPaymentRefund()->ref_num
            );

        }
        else{
            return $this ->redirectIndex("مشکلی در استرداد تراکنش رخ داده است" , true);
        }
    }



    public function destroy($bankPaymentAuthorityNum){
        $bankPayment = ContextRepository::BankPaymentRepository()->getPaymentDataAuthorityNum($bankPaymentAuthorityNum , false);
        if (!empty($bankPayment) && $bankPayment!=null){
            ContextRepository::FormRepository()->deleteResult($bankPayment);
            return $this ->redirectIndex("تراکنش با موفقیت حذف شد");
        }
        else{
            return $this ->redirectIndex("تراکنش یافت نشد" , true);
        }
    }

}
