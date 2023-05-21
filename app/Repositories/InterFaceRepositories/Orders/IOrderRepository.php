<?php
namespace App\Repositories\InterFaceRepositories\Orders;

use App\Http\Services\onTimeService\Basket\ModelInfoPriceBasket;
use App\Models\Orders\Order;
use App\Repositories\InterFaceRepositories\IBaseRepository;
use App\Tools\Models\Repositories\Banks\ModelVerifyBankPayment;
use App\Tools\Models\Repositories\Orders\ModelOrderPayment;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

/**
 * @template T
 * @template-extends IBaseRepository<T>
 */
interface IOrderRepository extends IBaseRepository {

    // ----------------------------------------
    /**
     * @return  ModelOrderPayment
     */
    function SetOrderForCookieBaskets($listBasket , ModelInfoPriceBasket $infoPrice , $codeOff = null ) :ModelOrderPayment;

    /**
     * @param int $orderId
     * @return  T
     */
    function GetOrderAndBaskets($orderId , $userId=0);

    /**
     * @param int $orderId
     * @param string $descriptionFinish
     * @return  T
     */
    function SetFinishOrder($orderId , $descriptionFinish , $userId=0);

    // ----------------------------------------
    /**
     * @param string $resNum
     * @param bool $isFinish
     * @param int $numInPage
     * @return  Collection<T>
     */
    function GetListOrdersUser($resNum="" , $isFinish=null);

    /**
     * @param string $resNum
     * @param bool $fullInfoPayment
     * @return  ModelVerifyBankPayment
     */
    function GetInfoOrderUser($resNum , $fullInfoPayment = false) :ModelVerifyBankPayment|null;


    //---------------------------

    /**
     * @param string $userSearch
     * @param string $resNumSearch
     * @param int $isFinishSearch
     * @return  LengthAwarePaginator
     */
    function getListOrders($userSearch="" , $resNumSearch="" , $isFinishSearch = -1 ,$numInPage = 15);

    /**
     * @param int $orderID
     * @return  ModelVerifyBankPayment
     */
    function getInfoOrder($orderID) :ModelVerifyBankPayment;

    /**
     * @param Order $order
     * @param string $descriptionFinish
     * @param int $isFinish
     * @return  bool
     */
    function setStateFinishOrder(Order $order , $descriptionFinish="" , $isFinish = 0);

    //---------------------------

    /**
     * @return  bool
     */
    function deleteOrdersWithoutBaskets();

}
