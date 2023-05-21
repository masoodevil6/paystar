<?php

namespace App\Http\Controllers\Admin\Offs;


use App\Http\Controllers\Admin\MainAdminController;
use App\Http\Requests\Admin\Off\CodeOffPublicRequest;
use App\Repositories\ContextRepository;


class CodeOffPublicAdminController extends MainAdminController
{

    function __construct()
    {
        parent::__construct(route("admin.offs.code-off-public.index" ) , true);
    }

    public function index(){
        $nav = [
            "part"=> "بخش مدیریت تخفیفات",
            "navigation" =>[
                [
                    "route" => "" ,
                    "current" => 1,
                    "title" => "لیست تخفیفات عمومی"
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

        $activeSearch = null;
        if (isset($_GET["active"])){
            $activeSearch = $_GET["active"];
        }

        $codeOffsPublic = ContextRepository::CodeOffRepository()->SearchListCodeOff($statusSearch , $orderSearch , $activeSearch , 1);

        return view("admin.off.code-off-public.index" ,
            compact(
                "nav" , "orderByList" ,
                "codeOffsPublic" ,
                "statusSearch" , "orderSearch" , "activeSearch"
            )
        );
    }



    public function create(){
        /// navigation page
        $nav = [
            "part"=> "بخش مدیریت تخفیفات",
            "navigation" =>[
                [
                    "route" => "admin.offs.code-off-public.index" ,
                    "current" => 0,
                    "title" => "لیست تخفیفات عمومی"
                ],
                [
                    "route" => "" ,
                    "current" => 1,
                    "title" => "افزودن کد تخفیف عمومی"
                ]
            ]
        ];

        return view("admin.off.code-off-public.create" , compact("nav"));
    }

    public function store(CodeOffPublicRequest $request){
        $input = $request->all();

        if ($request->hasFile('image_file')){
            $input["image"] = $this->uploadImageCodeOff($request->file('image_file'));

            $input["is_public"] = 1;

            ContextRepository::CodeOffRepository()->addResult($input);

            return $this ->redirectIndex(" کد تخفیف جدید با موفقیت اضافه شد");
        }

        return $this ->redirectIndex("آپلود تصویر با مشکل مواجه شد" , true , route("admin.offs.code-off-public.create") );
    }




    public function edit(int $codeOffId){

        $codeOffPublic = ContextRepository::CodeOffRepository()->GetCodeOff($codeOffId , 1);

        if (!empty($codeOffPublic)){
            /// navigation page
            $nav = [
                "part"=> "بخش مدیریت تخفیفات",
                "navigation" =>[
                    [
                        "route" => "admin.offs.code-off-public.index" ,
                        "current" => 0,
                        "title" => "لیست تخفیفات عمومی"
                    ],
                    [
                        "route" => "" ,
                        "current" => 1,
                        "title" => "ویرایش کد تخفیف عمومی"
                    ]
                ]
            ];

            return view("admin.off.code-off-public.create" , compact("nav" , "codeOffPublic"));
        }

        return $this ->redirectIndex("کد تخفیف یافت نشد" , true);
    }

    public function update(CodeOffPublicRequest $request, int $codeOffId){
        $input = $request->all();
        $codeOffPublic = ContextRepository::CodeOffRepository()->GetCodeOff($codeOffId , 1);
        if (!empty($codeOffPublic)){

            if ($request->hasFile('image_file')){
                $input["image"] = $this->uploadImageCodeOff($request->file('image_file') , $codeOffPublic -> image);
            }

            ContextRepository::CodeOffStatusRepository()->updateResult($codeOffPublic , $input);

            return $this ->redirectIndex("کد تخفیف با موفقیت اصلاح شد");
        }

        return $this ->redirectIndex("کد تخفیف یافت نشد" , true);
    }



    public function destroy(int $codeOffId){
        $codeOffPublic = ContextRepository::CodeOffRepository()->GetCodeOff($codeOffId , 1);
        if (!empty($codeOffPublic)){
            ContextRepository::CodeOffRepository()->deleteResult($codeOffPublic);
            if (!empty($codeOffPublic->image) && $codeOffPublic->image!=null){
                $this->DeleteImageFromServer($codeOffPublic->image);
            }
            return $this ->redirectIndex("کد تخفیف با موفقیت حذف شد");
        }
        return $this ->redirectIndex("کد تخفیف یافت نشد" , true);
    }


    public function status(int $codeOffId){
        $codeOffPublic = ContextRepository::CodeOffRepository()->GetCodeOff($codeOffId , 1);
        if (!empty($codeOffPublic)){
            $result = ContextRepository::CodeOffRepository()->changeStatusResult($codeOffPublic);
            if ($result["status"]){
                return $result["exp"];
            }
        }
        return null;
    }

    //----------------------------------------

    private function uploadImageCodeOff($image , $lastImage=null){

        $resultUploadImage = $this->uploadImageServer(
            $image ,
            "images".DIRECTORY_SEPARATOR."off-images",
            $lastImage ,
            false ,
            "",
            true
        );

        return $resultUploadImage;
    }

}
