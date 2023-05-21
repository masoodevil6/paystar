<?php

namespace App\Http\Controllers\Admin\Banks;

use App\Http\Controllers\Admin\MainAdminController;
use App\Http\Requests\Admin\Bank\BankPaymentRequest;
use App\Http\Requests\Admin\Bank\BankRequest;
use App\Http\Requests\Admin\Bank\TestPaymentRequest;
use App\Models\Banks\Bank;
use App\Models\Banks\BankPayment;
use App\Models\Banks\BankPaymentRefund;
use App\Models\Banks\BankPaymentUnVerify;
use App\Repositories\ContextRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;

class BankPaymentRefundAdminController extends MainAdminController
{
    function __construct()
    {
        parent::__construct(route("admin.banks.refund.index") );
    }



    public function index(){
        $nav = [
            "part"=> "بخش مدیریت بانک ها",
            "navigation" =>[
                [
                    "route" => "" ,
                    "current" => 1,
                    "title" => "لیست درخواست های استرداد"
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
        $authoritySearch = "";
        if (isset($_GET["authority_num"])){
            $authoritySearch = $_GET["authority_num"];
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
        $statusSearch = -1;
        if (isset($_GET["status"])){
            $statusSearch = $_GET["status"];
        }

        $banks = ContextRepository::BankRepository()->getAllResult();
        $bankPaymentRefunds = ContextRepository::BankPaymentRefundRepository()->GetListBankPaymentRefunds($resSearch , $refSearch ,$authoritySearch, $bankSearch , $userSearch , $resOrderSearch , $statusSearch);

        return view(
            "admin.banks.refund.index" ,
            compact(
                "nav" , "bankPaymentRefunds" , "banks" ,
                "resSearch" , "refSearch" , "authoritySearch", "bankSearch" , "userSearch" , "resOrderSearch" , "statusSearch"
            )
        );
    }



    public function show(BankPaymentRefund $bankPaymentRefund){
        /// navigation page
        $nav = [
            "part"=> "بخش مدیریت بانک ها",
            "navigation" =>[
                [
                    "route" => "admin.banks.refund.index" ,
                    "current" => 0,
                    "title" => "لیست درخواست های استرداد"
                ],
                [
                    "route" => "" ,
                    "current" => 1,
                    "title" => "اطلاعات درخواست استرداد"
                ]
            ]
        ];

        return view("admin.banks.refund.show" , compact("nav" , "bankPaymentRefund"));
    }




    public function destroy(BankPaymentRefund $bankPaymentRefund){
        ContextRepository::FormRepository()->deleteResult($bankPaymentRefund);
        return $this ->redirectIndex("درخواست استرداد با موفقیت حذف شد");
    }

}
