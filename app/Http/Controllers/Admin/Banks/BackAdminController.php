<?php

namespace App\Http\Controllers\Admin\Banks;

use App\Http\Controllers\Admin\MainAdminController;
use App\Http\Requests\Admin\Bank\BankRequest;
use App\Http\Requests\Admin\Bank\TestPaymentRequest;
use App\Models\Banks\Bank;
use App\Repositories\ContextRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;

class BackAdminController extends MainAdminController
{
    function __construct()
    {
        parent::__construct(route("admin.banks.bank.index") , true);
    }



    public function index(){
        $nav = [
            "part"=> "بخش مدیریت بانک ها",
            "navigation" =>[
                [
                    "route" => "" ,
                    "current" => 1,
                    "title" => "لیست بانک ها"
                ]
            ]
        ];

        $bankSearch = "";
        if (isset($_GET["bank"])){
            $bankSearch = $_GET["bank"];
        }
        $banks = ContextRepository::BankRepository()->SearchBank($bankSearch);

        return view("admin.banks.bank.index" , compact("nav" , "banks" , "bankSearch"));
    }



    public function create(){
        /// navigation page
        $nav = [
            "part"=> "بخش مدیریت بانک ها",
            "navigation" =>[
                [
                    "route" => "admin.banks.bank.index" ,
                    "current" => 0,
                    "title" => "لیست بانک ها"
                ],
                [
                    "route" => "" ,
                    "current" => 1,
                    "title" => "افزودن بانک"
                ]
            ]
        ];

        $classes = $this->getListPaymentsClass();

        return view("admin.banks.bank.create" , compact("nav" , "classes"));
    }

    public function store(BankRequest $request){
        $input = $request->all();

        $data=[
            "title" => $input["title"] ,
            "status" => $input["status"] ,
            "merchant_id" => $input["merchant_id"] ,
            "access_token" => $input["access_token"] ,
            "service_name" => $input["service_name"] ,
            "image_type" => 1
        ];

        if ($request->hasFile('image_file')){
            $data["image_location"] = $this->uploadImageBank($request->file('image_file'));
        }

        ContextRepository::BankRepository()->addResult($data);
        return $this ->redirectIndex("بانک جدید با موفقیت اضافه شد");
    }




    public function edit(Bank $bank){
        /// navigation page
        $nav = [
            "part"=> "بخش مدیریت بانک ها",
            "navigation" =>[
                [
                    "route" => "admin.banks.bank.index" ,
                    "current" => 0,
                    "title" => "لیست بانک ها"
                ],
                [
                    "route" => "" ,
                    "current" => 1,
                    "title" => "ویرایش بانک"
                ]
            ]
        ];

        $classes = $this->getListPaymentsClass();
        return view("admin.banks.bank.create" , compact("nav" , "bank" , "classes"));
    }

    public function update(BankRequest $request, Bank $bank){
        $input = $request->all();

        $data=[
            "title" => $input["title"] ,
            "status" => $input["status"] ,
            "merchant_id" => $input["merchant_id"] ,
            "access_token" => $input["access_token"] ,
            "service_name" => $input["service_name"] ,
            "image_type" => 1
        ];

        if ($request->hasFile('image_file')){
            $lastImage = null;
            if ($bank->image_type == 1){
                $lastImage = $bank-> image_location;
            }

            $data["image_location"] = $this->uploadImageBank($request->file('image_file') , $lastImage);
        }

        ContextRepository::BankRepository()->updateResult($bank , $data);
        return $this ->redirectIndex("بانک با موفقیت اصلاح شد");
    }

    public function destroy(Bank $bank){
        ContextRepository::BankRepository()->deleteResult($bank);
        if (!empty($bank->image) && $bank->image!=null){
            $this->DeleteImageFromServer($bank->image);
        }
        return $this ->redirectIndex("بانک با موفقیت حذف شد");
    }

    public function status(Bank $bank){
        $result = ContextRepository::BankRepository()->changeStatusResult($bank);
        if ($result["status"]){
            return $result["exp"];
        }
    }




    public function testPayment(Bank $bank){
        /// navigation page
        $nav = [
            "part"=> "بخش مدیریت بانک ها",
            "navigation" =>[
                [
                    "route" => "admin.banks.bank.index" ,
                    "current" => 0,
                    "title" => "لیست بانک ها"
                ],
                [
                    "route" => "" ,
                    "current" => 1,
                    "title" => "تست درگاه بانکی"
                ]
            ]
        ];

        $classes = $this->getListPaymentsClass();

        return view("admin.banks.bank.test" , compact("nav" , "bank" , "classes"));
    }

    public function submitTestPayment(TestPaymentRequest $request , BanksService $banksService){
        $input = $request->all();
        $resultSubmitRequestPayment = $banksService->SubmitRequestPayment($input["class_name"] , $input["amount"]  , true );

        if ($resultSubmitRequestPayment->isStatus()){
            return redirect()->to($resultSubmitRequestPayment->getRedirect());
        }
        else{
            return $this ->redirectIndex($resultSubmitRequestPayment->getMessage() , true);
        }
    }

    public function resultTestPayment($bankName , Request $request , BanksService $banksService){

        /// navigation page
        $nav = [
            "part"=> "بخش مدیریت بانک ها",
            "navigation" =>[
                [
                    "route" => "admin.banks.bank.index" ,
                    "current" => 0,
                    "title" => "لیست بانک ها"
                ],
                [
                    "route" => "" ,
                    "current" => 1,
                    "title" => "نتیجه تست درگاه بانکی"
                ]
            ]
        ];

        $dataResult = $request->all();
        $resultPayment = $banksService->GetResultRequestPayment($bankName , $dataResult , true);

        return view("admin.banks.bank.test-result" , compact("nav" , "resultPayment"));
    }




    //// =======================================
    private function getListPaymentsClass(){
        return Config::get("payments.payments");
    }

    private function getNameSpaceClass($name){

        $forms = $this->getListPaymentsClass();

        foreach ($forms as $form){
            if ($form->getName() == $name){
                return $form->getClass();
            }
        }

        return null;
    }


    private function uploadImageBank($image , $lastImage=null){

        $resultUploadImage = $this->uploadImageServer(
            $image ,
            "images".DIRECTORY_SEPARATOR."bank-images",
            $lastImage,
            false ,
            "",
            true
        );

        return $resultUploadImage;
    }
}
