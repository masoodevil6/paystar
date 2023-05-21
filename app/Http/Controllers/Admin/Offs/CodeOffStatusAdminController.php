<?php

namespace App\Http\Controllers\Admin\Offs;


use App\Http\Controllers\Admin\MainAdminController;
use App\Http\Requests\Admin\Off\CodeOffStatusRequest;
use App\Models\Offs\CodeOffStatus;
use App\Repositories\ContextRepository;


class CodeOffStatusAdminController extends MainAdminController
{

    function __construct()
    {
        parent::__construct(route("admin.offs.code-off-status.index"));
    }

    public function index(){
        $nav = [
            "part"=> "بخش مدیریت تخفیفات",
            "navigation" =>[
                [
                    "route" => "" ,
                    "current" => 1,
                    "title" => "لیست شروط تولید کد تخفیف"
                ]
            ]
        ];

        $orderByList = ContextRepository::CodeOffStatusRepository()->GetListOrderBy();

        $statusSearch = null;
        if (isset($_GET["status"])){
            $statusSearch = $_GET["status"];
        }

        $orderSearch = null;
        if (isset($_GET["order"])){
            $orderSearch = $_GET["order"];
        }

        $codeOffStatuses = ContextRepository::CodeOffStatusRepository()->SearchCodeOffStatusByStatusAndOrderBy($statusSearch , $orderSearch);

        return view("admin.off.code-off-status.index" , compact("nav" , "orderByList" , "codeOffStatuses" , "statusSearch" , "orderSearch"));
    }



    public function create(){
        /// navigation page
        $nav = [
            "part"=> "بخش مدیریت تخفیفات",
            "navigation" =>[
                [
                    "route" => "admin.offs.code-off-status.index" ,
                    "current" => 0,
                    "title" => "لیست شروط تولید کد تخفیف"
                ],
                [
                    "route" => "" ,
                    "current" => 1,
                    "title" => "افزودن شرط تولید کد تخفیف"
                ]
            ]
        ];

        return view("admin.off.code-off-status.create" , compact("nav"));
    }

    public function store(CodeOffStatusRequest $request){
        $input = $request->all();
        ContextRepository::CodeOffStatusRepository()->addResult($input);
        return $this ->redirectIndex("شرط جدید تولید کد تخفیف با موفقیت اضافه شد");
    }




    public function edit(CodeOffStatus $codeOffStatus){
        /// navigation page
        $nav = [
            "part"=> "بخش مدیریت تخفیفات",
            "navigation" =>[
                [
                    "route" => "admin.offs.code-off-status.index" ,
                    "current" => 0,
                    "title" => "لیست شروط تولید کد تخفیف"
                ],
                [
                    "route" => "" ,
                    "current" => 1,
                    "title" => "ویرایش شرط تولید کد تخفیف"
                ]
            ]
        ];

        return view("admin.off.code-off-status.create" , compact("nav" , "codeOffStatus"));
    }

    public function update(CodeOffStatusRequest $request, CodeOffStatus $codeOffStatus){
        $input = $request->all();
        ContextRepository::CodeOffStatusRepository()->updateResult($codeOffStatus , $input);
        return $this ->redirectIndex("شرط تولید کد تخفیف با موفقیت اصلاح شد");
    }



    public function destroy(CodeOffStatus $codeOffStatus){
        ContextRepository::CodeOffStatusRepository()->deleteResult($codeOffStatus);
        return $this ->redirectIndex("شرط تولید کد تخفیف با موفقیت حذف شد");
    }


    public function status(CodeOffStatus $codeOffStatus){
        $result = ContextRepository::CodeOffStatusRepository()->changeStatusResult($codeOffStatus);
        if ($result["status"]){
            return $result["exp"];
        }
    }

}
