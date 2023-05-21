<?php
namespace App\Repositories\InterFaceRepositories\Orders;

use App\Http\Services\onTimeService\Basket\ModelBasket;
use App\Repositories\InterFaceRepositories\IBaseRepository;
use Illuminate\Database\Eloquent\Collection;

/**
 * @template T
 * @template-extends IBaseRepository<T>
 */
interface IOrderBasketRepository extends IBaseRepository {

    /**
     * @return  T
     */
    function checkExistBasket($orderBasketType, $orderBasketId, $cookie);

    /**
     * @return  T|false
     */
    function addToBasket($orderBasketType, $orderBasketId, $cookie);

    /**
     * @return  Collection<T>
     */
    function getAllBasket($cookie);

    /**
     * @return  bool
     */
    function deleteFromBasket(int $basketId , $cookie);

    /**
     * @return  bool
     */
    function updateFinishDataBasket(ModelBasket $modelBasket , $orderId);

    /**
     * @return  bool
     */
    function setBasketFinishWidthDeleteCookie($orderBasketId , $submitted);

    /**
     * @return  void
     */
    function getCountInBasket($cookie);

    /**
     * @return  bool
     */
    function DeleteOrderBasketExpired();


}
