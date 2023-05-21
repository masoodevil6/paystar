<?php
namespace App\Repositories\InterFaceRepositories\Offs;


use App\Repositories\InterFaceRepositories\IBaseRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

/**
 * @template T
 * @template-extends IBaseRepository<T>
 */
interface ICodeOffRepository extends IBaseRepository {

    /**
     * @return  array
     */
    function GetListOrderBy();

    /**
     * @return  LengthAwarePaginator
     */
    function SearchListCodeOff($status = null,$orderBy = null , $isActive=null  ,$public=0 , $numInPage = 15);

    /**
     * @return  T
     */
    function GetCodeOff(int $id , int $public=0);

    /**
     * @return  array
     */
    function CheckCodeOff($codeOff , $orderAmount);

    /**
     * @return  bool
     */
    function setUsedCodeOff($codeOff);

    /**
     * @return  array
     */
    function GetImageLastActiveCodeOffPublic();

    //---------------------
    /**
     * @return  void
     */
    function DeleteCodeOffExpired();

}
