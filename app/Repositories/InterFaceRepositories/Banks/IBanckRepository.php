<?php
namespace App\Repositories\InterFaceRepositories\Banks;

use App\Repositories\InterFaceRepositories\IBaseRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

/**
 * @template T
 * @template-extends IBaseRepository<T>
 */
interface IBanckRepository extends IBaseRepository {

    /**
     * @return  LengthAwarePaginator
     */
    function SearchBank(string $bankName="" ,$numInPage = 15);

    /**
     * @return  T
     */
    function GetMerchantIdFromServiceName(string $serviceName);

    /**
     * @return  T
     */
    function GetMerchantIdAndAccessTokenFromServiceName(string $className);

    /**
     * @return  T
     */
    function GetListPaymentThatActive();

    /**
     * @return  bool
     */
    function CheckExistBank($className);






}
