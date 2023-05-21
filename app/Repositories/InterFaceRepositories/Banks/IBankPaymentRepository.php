<?php
namespace App\Repositories\InterFaceRepositories\Banks;

use App\Http\Services\Banks\BanksService\Models\ModelResultPayment;
use App\Http\Services\ContextService\Payment\BaseService\Models\ResultVerifyPaymentModel;
use App\Models\Banks\BankPayment;
use App\Repositories\InterFaceRepositories\IBaseRepository;
use App\Tools\Models\Repositories\Banks\ModelVerifyBankPayment;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

/**
 * @template T
 * @template-extends IBaseRepository<T>
 */
interface IBankPaymentRepository extends IBaseRepository {

    /**
     * @return  T|null
     */
    function addSubmitRequest(
        $service_name ,
        $is_test , $orderId , $user_id ,
        $resNum , $authorityNum ,
        $amount , $description ,
        $mobile , $email );

    /**
     * @return  T|null
     */
    function addSubmitRequestWithRefNum(
        $service_name,
        $is_test , $orderId , $user_id ,
        $resNum , $refNum ,  $authorityNum ,
        $amount , $description ,
        $mobile , $email );

    /**
     * @return  bool
     */
    function setCancelPayment($authorityNum , $message);

    /**
     * @return  bool
     */
    function setSuspensionPaymentFromAuthorityNum($authorityNum , $message , $thisClient=true);

    /**
     * @return  bool
     */
    function setFailedPaymentFromAuthorityNum($authorityNum , $code, $codeMessage , $thisClient=true);


    /**
     * @return T
     */
    function getPaymentDataAuthorityNum($authorityNum , $thisClient=true);


    /**
     * @return T
     */
    function getPaymentDataResNum($resNum , $thisClient=true);


    /**
     * @return T
     */
    function getPaymentDataResNumAndRefNum($resNum , $refNum);



    /**
     * @return  bool
     */
    function setVerifyDataPayment($code , $codeMessage , $refId , $extraData , $authorityNum , $thisClient=true);

    /**
     * @return ModelVerifyBankPayment
     */
    function setResultVerifyDataPayment($bankName , $dataResult , $userId=0) :ModelVerifyBankPayment;


    /**
     * @return ResultVerifyPaymentModel
     */
    function GetModelResultPaymentFromPayment(BankPayment $bankPayment ,$fullRecord=false) :ResultVerifyPaymentModel;


    // ----------------------------------------------------

    /**
     * @param string $resSearch bank payment res num
     * @param string $refSearch bank payment ref num
     * @param string $bankSearch bank name en
     * @param string $userSearch user full name
     * @param string $resOrderSearch order res num
     * @param int $testSearch is_test for bank payment
     * @param int $statusSearch is_test for bank payment
     * @param int $numInPage num in pages
     * @return  LengthAwarePaginator
     */
    function GetListBankPayments($resSearch="" , $refSearch="" , $bankSearch="" , $userSearch="" , $resOrderSearch="" , $testSearch=-1 , $statusSearch=-1,$numInPage = 15);

    /**
     * @param BankPayment $bankPayment
     * @param int $status
     * @param string $textAdmin
     * @return bool
     */
    function SubmitAdminTextBankPayment(BankPayment $bankPayment , $status , $textAdmin);


}
