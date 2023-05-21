<?php

namespace App\Repositories\InterFaceRepositories\PhoneStores;

use App\Models\PhoneStores\PhoneStore;
use App\Repositories\InterFaceRepositories\IBaseRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

/**
 * @template T
 * @template-extends IBaseRepository<T>
 */
interface IPhoneStoreRequestTokenRepository extends IBaseRepository {

    /**
     * @return  LengthAwarePaginator
     */
    function searchPhoneStoreRequestToken( $phoneStore = 0 ,$numInPage = 15);

    /**
     * @return  T
     */
    function getLastPhoneStoreRequestToken(PhoneStore $phoneStore);

}
