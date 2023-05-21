<?php
namespace App\Repositories\ModelRepositories\Orders;

use App\Http\Services\onTimeService\Basket\ModelBasket;
use App\Models\Orders\OrderBasket;
use App\Repositories\ContextRepository;
use App\Repositories\InterFaceRepositories\Orders\IOrderBasketRepository;
use App\Repositories\ModelRepositories\BaseRepository;
use Carbon\Carbon;
use Illuminate\Support\Facades\View;

/**
 * @template-extends BaseRepository<OrderBasket>
 * @template-implements  IOrderBasketRepository<OrderBasket>
 */
class OrderBasketRepository extends BaseRepository implements IOrderBasketRepository {

    public function __construct()
    {
        parent::__construct(new OrderBasket());
    }

    /**
     * @inheritDoc
     */
    function checkExistBasket($orderBasketType, $orderBasketId, $cookie)
    {
        return $this->model
            ->where("order_basketable_type" , $orderBasketType )
            ->where("order_basketable_id" , $orderBasketId )
            ->where("cookie" , $cookie )
            ->first();
    }

    /**
     * @inheritDoc
     */
    function addToBasket($orderBasketType, $orderBasketId, $cookie)
    {
        $recordExist = $this->checkExistBasket($orderBasketType , $orderBasketId , $cookie );
        if (empty($recordExist)){
            return $this->addResult([
                "order_basketable_type" => $orderBasketType ,
                "order_basketable_id" => $orderBasketId ,
                "cookie" => $cookie ,
            ]);
        }
        else{
            return $recordExist;
        }
    }

    /**
     * @inheritDoc
     */
    function getAllBasket($cookie)
    {
        return $this->model
            ->where("cookie" , $cookie )
            ->get();
    }

    /**
     * @inheritDoc
     */
    function deleteFromBasket(int $basketId, $cookie)
    {
        return $this->model
            ->where("id" , $basketId )
            ->where("cookie" , $cookie )
            ->delete();
    }

    /**
     * @inheritDoc
     */
    function updateFinishDataBasket(ModelBasket $modelBasket , $orderId)
    {
        $listDescriptions=[];
        foreach ($modelBasket->getItemDescription() as $description){
            array_push($listDescriptions , $description->toArray());
        }

        return $this->model
            ->where("id" , $modelBasket->getItemId())
            ->where("cookie" , $modelBasket->getItemCookie())
            ->update([
                "name" => $modelBasket->getItemName(),
                "description" => $listDescriptions,
                "price" => $modelBasket->getItemPrice(),
                "off" => $modelBasket->getItemOffPrice(),
                "order_id" => $orderId ,
            ]);
    }

    /**
     * @inheritDoc
     */
    function setBasketFinishWidthDeleteCookie($orderBasketId , $submitted)
    {
        return $this->model
            ->where("id" , $orderBasketId)
            ->update([
                "cookie" => null ,
                "submitted" => $submitted ,
            ]);
    }

    /**
     * @inheritDoc
     */
    function getCountInBasket($cookie)
    {
        $basketCount= $this->model->where("cookie" , $cookie)->count();

        View::composer("vue.layouts.header" , function ($view) use($basketCount){
            $view->with("basketCount" , $basketCount);
        });
    }


    /**
     * @inheritDoc
     */
    function DeleteOrderBasketExpired()
    {
        return $this->model
            ->whereNull("order_id")
            ->where("updated_at" , "<=" , Carbon::now()->subDays(ContextRepository::UserRepository()->getCookiePeriod())->toDateTimeString())
            ->delete();
    }
}
