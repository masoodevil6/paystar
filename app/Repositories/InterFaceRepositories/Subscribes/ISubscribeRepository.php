<?php
namespace App\Repositories\InterFaceRepositories\Subscribes;

use App\Repositories\InterFaceRepositories\IBaseRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

/**
 * @template T
 * @template-extends IBaseRepository<T>
 */
interface ISubscribeRepository extends IBaseRepository {

    /**
     * @return  LengthAwarePaginator
     */
    function SearchSubscribe(string $subscribeName="" , $numInPage=15);

    /**
     * @return  Collection<T>
     */
    function GetLimitRandomSelectedSubscribe(int $limitSubscribe=10 , int $limitForm=6);

    /**
     * @return  LengthAwarePaginator
     */
    function GetListSubscribes($numInPage=8 , int $limitForm=6 );

    /**
     * @return  T
     */
    function GetInfoSubscribe($slug);

    /**
     * @return  T
     */
    function GetInfoSubscribeWithSelectedForm($slug , $numForm=10);

    /**
     * @return  string
     */
    function GetSlugSubscribeForm($subscribe_id);

    /**
     * @return  string
     */
    function getSqlSubscribeWithSlug($slug);

    /**
     * @return  LengthAwarePaginator
     */
    function getListSeoPagesSubscirbe( $numInPage=15);



}
