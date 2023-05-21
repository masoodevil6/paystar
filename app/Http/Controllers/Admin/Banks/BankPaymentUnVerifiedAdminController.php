<?php

namespace App\Http\Controllers\Admin\Banks;

use App\Http\Controllers\Admin\MainAdminController;
use App\Http\Requests\Admin\Bank\BankPaymentRequest;
use App\Http\Requests\Admin\Bank\BankRequest;
use App\Http\Requests\Admin\Bank\TestPaymentRequest;
use App\Models\Banks\Bank;
use App\Models\Banks\BankPayment;
use App\Models\Banks\BankPaymentUnVerify;
use App\Repositories\ContextRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;

class BankPaymentUnVerifiedAdminController extends MainAdminController
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
                    "title" => "لیست تراکتش های Un-Verified"
                ]
            ]
        ];

        $resSearch = "";
        if (isset($_GET["res_num"])){
            $resSearch = $_GET["res_num"];
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
        $bankPaymentUnVerifies = ContextRepository::BankPaymentUnVerifyRepository()->GetListBankPaymentUnVerifies($resSearch , $bankSearch , $userSearch , $resOrderSearch , $statusSearch);

        return view(
            "admin.banks.un-verified.index" ,
            compact(
                "nav" , "bankPaymentUnVerifies" , "banks" ,
                "resSearch" , "bankSearch" , "userSearch" , "resOrderSearch" , "statusSearch"
            )
        );
    }



    public function show(BankPaymentUnVerify $bankPaymentUnVerified){
        /// navigation page
        $nav = [
            "part"=> "بخش مدیریت بانک ها",
            "navigation" =>[
                [
                    "route" => "admin.banks.un-verifies.index" ,
                    "current" => 0,
                    "title" => "لیست تراکتش های Un-Verified"
                ],
                [
                    "route" => "" ,
                    "current" => 1,
                    "title" => "اطلاعات تراکتش Un-Verified"
                ]
            ]
        ];

        return view("admin.banks.un-verified.show" , compact("nav" , "bankPaymentUnVerified"));
    }




    public function destroy(BankPaymentUnVerify $bankPaymentUnVerified){
        ContextRepository::FormRepository()->deleteResult($bankPaymentUnVerified);
        return $this ->redirectIndex("تراکنش un-verified با موفقیت حذف شد");
    }

}
