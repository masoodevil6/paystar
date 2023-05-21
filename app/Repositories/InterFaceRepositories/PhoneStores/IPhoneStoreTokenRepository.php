<?php

namespace App\Repositories\InterFaceRepositories\PhoneStores;

use App\Models\PhoneStores\PhoneStore;
use App\Models\PhoneStores\PhoneStoreToken;
use App\Repositories\InterFaceRepositories\IBaseRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

/**
 * @template T
 * @template-extends IBaseRepository<T>
 */
interface IPhoneStoreTokenRepository extends IBaseRepository {

    /**
     * @return  LengthAwarePaginator
     */
    function searchPhoneStoreToken($phoneStore = 0 , $numInPage = 15);


    /**
     * @return  bool
     */
    function setExpireLastAppStoreToken($phoneStoreId , $phoneStoreRequestTokenId);

    /**
     * @return  T|null
     */
    function addAppStoreToken($accessToken , $timeExpireUnit , $timeExpireValue , $phoneStoreId , $phoneStoreRequestTokenId ,  $Status);

    /**
     * @return  bool
     */
    function updateAppStoreToken(PhoneStoreToken $phoneStoreToken ,$accessToken , $timeExpireUnit , $timeExpireValue , $phoneStoreId , $phoneStoreRequestTokenId ,  $Status);


    /**
     * @return  T
     */
    function getLastActiveAppStoreToken(PhoneStore $phoneStore);

}
