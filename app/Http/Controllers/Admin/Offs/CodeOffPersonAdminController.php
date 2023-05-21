<?php

namespace App\Http\Controllers\Admin\Offs;

use App\Http\Controllers\Admin\MainAdminController;
use App\Http\Requests\Admin\Off\CodeOffPersonRequest;
use App\Repositories\ContextRepository;
use Illuminate\Http\Request;

class CodeOffPersonAdminController extends MainAdminController
{

    function __construct()
    {
        parent::__construct(route("admin.offs.code-off-person.index"));
    }

    public function index(){
        $nav = [
            "part"=> "بخش مدیریت تخفیفات",
            "navigation" =>[
                [
                    "route" => "" ,
                    "current" => 1,
                    "title" => "لیست تخفیفات شخصی"
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

        $codeOffsPerson = ContextRepository::CodeOffRepository()->SearchListCodeOff($statusSearch , $orderSearch , $activeSearch);

        return view("admin.off.code-off-person.index" ,
            compact(
                "nav" , "orderByList" ,
                "codeOffsPerson" ,
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
                    "title" => "لیست تخفیفات شخصی"
                ],
                [
                    "route" => "" ,
                    "current" => 1,
                    "title" => "افزودن کد تخفیف شخصی"
                ]
            ]
        ];

        $search = "";
        if (isset($_GET["search"])){
            $search = $_GET["search"];
        }
        $users = $this->searchUsersWithEmail($search);

        return view("admin.off.code-off-person.create" , compact("nav" , "users" , "search"));
    }

    public function store(CodeOffPersonRequest $request){
        $input = $request->all();

        foreach ($input["users"] as $itemUserEmail){
            $user = ContextRepository::UserRepository()->SearchUserFirstWithEmail($itemUserEmail);
            if (!empty($user) && $user != null){
                $code = randomString();
                $minPrice = $input["min_price"];
                $period = $input["period"];
                $userId = $user->id;

                ContextRepository::CodeOffRepository()->addResult([
                    "code" => $code ,
                    "min_price" => $minPrice ,
                    "off_price" => $input["off_price"] ,
                    "period" => $period ,
                    "is_public" => 0 ,
                    "user_id" => $userId
                ]);

                ContextRepository::UserMessageRepository()->SendMessage(
                    ContextRepository::UserMessageRepository()->InfoMessage_AdminCreateCodeOffForClient($code , $period , $minPrice ) ,
                    $userId
                );
            }
        }

        return $this ->redirectIndex(" کد تخفیف جدید با موفقیت اضافه شد");

    }


    public function searchUsers(Request $request){
        return $this->searchUsersWithEmail($request->get("search"));
    }



    public function destroy(int $codeOffId){
        $codeOffPublic = ContextRepository::CodeOffRepository()->GetCodeOff($codeOffId);
        if (!empty($codeOffPublic)){
            ContextRepository::CodeOffRepository()->deleteResult($codeOffPublic);
            return $this ->redirectIndex("کد تخفیف با موفقیت حذف شد");
        }
        return $this ->redirectIndex("کد تخفیف یافت نشد" , true);
    }


    public function status(int $codeOffId){
        $codeOffPublic = ContextRepository::CodeOffRepository()->GetCodeOff($codeOffId);
        if (!empty($codeOffPublic)){
            $result = ContextRepository::CodeOffRepository()->changeStatusResult($codeOffPublic);
            if ($result["status"]){
                return $result["exp"];
            }
        }
        return null;
    }


    /// ===========
    private function searchUsersWithEmail($search=""){
        return ContextRepository::UserRepository()->SearchUserWithEmail($search);
    }

}
