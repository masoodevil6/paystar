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
interface IBankPaymentRefundRepository extends IBaseRepository {

    /**
     * @param  int $code
     * @param  string $message
     * @param  string $message
     * @param  string $resNum
     * @param  string $refNum
     * @param  array $extraData
     * @param  BankPayment $bankPayment
     * @param  bool $status
     * @return T
     */
    function AddBankPaymentRefundSuccess($code , $message , $resNum , $refNum ,array $extraData ,BankPayment $bankPayment , $status);

    //---------------------------------------------------------

    /**
     * @param string $resSearch bank payment res num
     * @param string $refSearch bank payment ref num
     * @param string $authoritySearch bank payment authority num
     * @param string $bankSearch bank name en
     * @param string $userSearch user full name
     * @param string $resOrderSearch order res num
     * @param int $testSearch is_test for bank payment
     * @param int $statusSearch is_test for bank payment
     * @param int $numInPage num in pages
     * @return  LengthAwarePaginator
     */
    function GetListBankPaymentRefunds($resSearch="" , $refSearch="" , $authoritySearch="", $bankSearch="" , $userSearch="" , $resOrderSearch="" , $statusSearch=-1,$numInPage = 15);


}
