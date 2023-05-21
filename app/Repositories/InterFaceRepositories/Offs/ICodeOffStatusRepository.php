<?php
namespace App\Repositories\InterFaceRepositories\Offs;

use App\Repositories\InterFaceRepositories\IBaseRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

/**
 * @template T
 * @template-extends IBaseRepository<T>
 */
interface ICodeOffStatusRepository extends IBaseRepository {

    /**
     * @return  array
     */
    function GetListOrderBy();

    /**
     * @return  LengthAwarePaginator
     */
    function SearchCodeOffStatusByStatusAndOrderBy($status = null, $orderBy = null , $numInPage = 15);

}
