<?php
namespace App\Repositories\InterFaceRepositories;

use App\Models\Panel\Admin;
use App\ViewModel\ABaseViewModel;
use App\ViewModel\Panel\AdminModel;
use App\ViewModel\Panel\AdminViewModel;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * @template TModel
 */
interface IBaseRepository
{
    /**
     * @return  Collection<TModel>
     */
    function getAllResult($ifStatus=false);

    /**
     * @return  LengthAwarePaginator
     */
    function getPaginateResult( $ifStatus=false , $numInPage=15);

    /**
     * @return  TModel
     */
    function getResult($resultId , $ifStatus=false) ;

    /**
     * @return  TModel|null
     */
    function addResult($result)  ;

    /**
     * @return  array|null
     */
    function changeStatusResult(Model $model , $field="status" , $defaultValue=null);

    /**
     * @return  bool
     */
    function updateResult(Model $result , $data) : bool;

    /**
     * @return  bool
     */
    function deleteResult(Model $result) : bool ;


    /**
     * @return  bool
     */
    function deleteResultById(int $resultId) : bool ;


    /**
     * @return  void
     */
    function save($model) : void ;



    /**
     * @return TModel
     */
    function addSearcher(string $property , string $value);

}
