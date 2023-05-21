<?php
namespace App\Repositories\InterFaceRepositories\Subscribes;

use App\Repositories\InterFaceRepositories\IBaseRepository;
use App\Tools\Models\Repositories\Banks\ModelPublicBankPayment;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

/**
 * @template T
 * @template-extends IBaseRepository<T>
 */
interface ISubscribePaymentRepository extends IBaseRepository {

    /**
     * @return  int
     */
    function CreateRecordForUser(string $userEmail ,  array $data) : int ;

    /**
     * @return  LengthAwarePaginator
     */
    function SearchSubscribePayment(string $userName="", string $resNum="" , int $Status=-1, int $subscribe=0 , $numInPage=15);

    /**
     * @return  LengthAwarePaginator
     */
    function GetAllSubscribeAuthUser($numInPage=15);

    /**
     * @return  array
     */
    function GetInfoSubscribeAuthUser($subscribeId);

    /**
     * @return  T|bool
     */
    function DeleteSubscribeAuthUser($subscribeId);

    /**
     * @return  Collection<T>
     */
    function GetSubscribeActiveNow();

    /**
     * @return  Collection<T>
     */
    function GetSubscribeActiveNowWithTimeStamp();

    /**
     * @return  int|string
     */
    function checkSubscribeActiveForUser($subscribeId , $userId=0);

    /**
     * @return  bool
     */
    function AddSubscribePaymentFromPayment($subscribeId , ModelPublicBankPayment $modelPublicBankPayment , $userId=0)  : bool ;
}
