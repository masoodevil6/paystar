<?php

namespace App\Http\Controllers\API\User;

use App\Http\Controllers\Controller;
use App\Http\Services\onTimeService\Login\VerifyInput;
use App\Repositories\ContextRepository;
use Illuminate\Http\Request;
use function checkEmailGet;
use function checkPhoneGet;
use function response;

class UserPersonApiController extends Controller
{

    /* [POST]
     * ====================================
     *  url=> /user/person/info
     *====================================
     *  SEND: NULL
     * ====================================
     *  RETURN: ["name" , "family" , "cart_number"]]
     */

    public function getInfoClient(){
        $data = ContextRepository::UserRepository()->GetUserAuthInfo();
        return [
            "name" => $data["name"],
            "family" => $data["family"],
            "cart_number" => $data["cart_number"]
        ];
    }


    /* [POST]
     * ====================================
     *  url=> /user/person/set
     *====================================
     *  SEND: OBJECT["name" , "family" , "cart_num"]
     * ====================================
     *  RETURN: String[msg]
     */
    public function setUserInfo(Request $request){

        $name = "";
        if ($request->has("userName")){
            $name = $request-> userName;
        }

        $family = "";
        if ($request->has("userFamily")){
            $family = $request-> userFamily;
        }

        $cartNum = "";
        if ($request->has("userCartNum")){
            $cartNum = $request-> userCartNum;
        }

        ContextRepository::UserRepository()->UpdateUserInfo($name , $family , $cartNum );

        return "اطلاعات با موفقیت ویرایش شد";
    }

}
