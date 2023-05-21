<?php
namespace App\Repositories\InterFaceRepositories\Banks;

use App\Http\Services\Banks\BanksService\Models\ModelResultPayment;
use App\Models\Banks\BankPayment;
use App\Repositories\InterFaceRepositories\IBaseRepository;
use App\Tools\Models\Repositories\Banks\ModelVerifyBankPayment;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

/**
 * @template T
 * @template-extends IBaseRepository<T>
 */
interface IBankPaymentUnVerifyRepository extends IBaseRepository {

    /**
     * @param  string $authority
     * @param  int $amount
     * @param  $dateSubmit
     * @param  array $extraData
     * @param  string $paymentClassName
     * @return T
     */
    function AddBankPaymentUnVerifiedNotFound($authority , $amount , $dateSubmit ,array $extraData , $paymentClassName);


    /**
     * @param  BankPayment $bankPayment
     * @param  string $authority
     * @param  int $amount
     * @param  $dateSubmit
     * @param  array $extraData
     * @param  string $paymentClassName
     * @return T
     */
    function AddBankPaymentUnVerifiedSuccess(BankPayment $bankPayment ,$authority , $amount , $dateSubmit ,array $extraData , $paymentClassName);


    //-----------------------------------------------------

    /**
     * @param string $resSearch bank payment res num
     * @param string $bankSearch bank name en
     * @param string $userSearch user full name
     * @param string $resOrderSearch order res num
     * @param int $statusSearch is_test for bank payment
     * @param int $numInPage num in pages
     * @return  LengthAwarePaginator
     */
    function GetListBankPaymentUnVerifies($resSearch="" , $bankSearch="" , $userSearch="" , $resOrderSearch="" ,  $statusSearch=-1,$numInPage = 15);




}
