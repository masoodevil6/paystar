<?php

namespace App\Repositories\InterFaceRepositories\PhoneStores;

use App\Models\PhoneStores\PhoneStore;
use App\Models\PhoneStores\PhoneStorePurchase;
use App\Models\Subscribes\Subscribe;
use App\Repositories\InterFaceRepositories\IBaseRepository;
use App\Tools\Models\Purchase\InfoPurchase;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

/**
 * @template T
 * @template-extends IBaseRepository<T>
 */
interface IPhoneStorePurchaseRepository extends IBaseRepository {


    /**
     * @return  LengthAwarePaginator
     */
    function searchPhoneStorePurchase($phoneStoreSearch = 0  , $subscribeSearch=0 ,$purchaseSearch="" , $resNum ="" ,$userSearch="" , $numInPage = 15);




    //--------------------------------------------------

    /**
     * @return  array|null
     */
    function addNewPhoneStorePurchaseBeforePayment(Subscribe $subscribe , PhoneStore $phoneStore , $codeOff);

    /**
     * @return  T|null
     */
    function checkPurchasePayment(InfoPurchase $infoPurchase);

    /**
     * @return  T|null
     */
    function setConsumptionPayment(PhoneStorePurchase $phoneStorePurchase);




    //--------------------------------------------------

    /**
     * @return  Collection<T>
     */
    function getListClientPhoneStore($resNum="" , $isFinish=null  , $numInPage = 10);


    /**
     * @return  T
     */
    function getClientPhoneStore($resNum="");

}
