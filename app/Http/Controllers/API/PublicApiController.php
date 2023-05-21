<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Subscribes\Subscribe;
use App\Repositories\ContextRepository;
use Illuminate\Http\Request;

class PublicApiController extends BaseApiController
{





    /* [POST]
     * ====================================
     *  url=> /subscribes?{page}=
     *====================================
     *  param Get = ?page=
     * ====================================
     * LIST[OBJECT] [ "id" ,"title" ,"real_price" ,"off_price" ,"duration" ,"description" ,"slug"  , "active"]
     */
    public function subscribes(){
        return ContextRepository::SubscribeRepository()->getAllResult();
    }



    /* [POST]
     * ====================================
     *  url=> /subscribe/{subscribeSlug}
     *====================================
     *  param url = {subscribeSlug}
     * ====================================
     * OBJECT [ "id" ,"title" ,"real_price" ,"off_price" ,"duration" ,"description" ,"slug"  , "active" , "existInBasket"]
     */
    public function subscribe(Request $request , $subscribeSlug="" ){
        $cookie=null;
        if ($request->has("cookie")){
            $cookie = $request->cookie;
        }

        $subscribe = ContextRepository::SubscribeRepository()->GetInfoSubscribe( $subscribeSlug , 0);
        $subscribe->existInBasket = false;
        if (!empty($subscribe) && $subscribe != null && !$subscribe->active && $cookie!=null && !empty($cookie)){
            $recordInBasket = ContextRepository::OrderBasketRepository()->checkExistBasket(Subscribe::class ,$subscribe->id , $cookie );
            if (!empty($recordInBasket) && $recordInBasket!=null){
                $subscribe->existInBasket = true;
            }
        }

        return $subscribe;
    }



}
