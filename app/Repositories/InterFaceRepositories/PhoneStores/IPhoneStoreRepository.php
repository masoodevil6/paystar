<?php

namespace App\Repositories\InterFaceRepositories\PhoneStores;

use App\Repositories\InterFaceRepositories\IBaseRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

/**
 * @template T
 * @template-extends IBaseRepository<T>
 */
interface IPhoneStoreRepository extends IBaseRepository {

    /**
     * @return  LengthAwarePaginator
     */
    function searchPhoneStores( $phoneStoreClassName = "" ,$numInPage = 15);

    /**
     * @return  T
     */
    function getPhoneStoreWithClassName($phoneStoreClassName , $checkStatus=false);

}
