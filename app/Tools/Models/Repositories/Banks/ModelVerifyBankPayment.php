<?php
namespace App\Tools\Models\Repositories\Banks;

use App\Http\Services\ContextService\Payment\BaseService\Models\ResultVerifyPaymentModel;

use App\Http\Services\onTimeService\Basket\ModelBasket;
use App\Http\Services\onTimeService\Basket\ModelInfoPriceBasket;
use App\Models\Orders\Order;
use App\Tools\Models\IModelBaseList;
use App\Tools\Models\ModelBaseList;
use Illuminate\Support\Facades\Config;

class ModelVerifyBankPayment{

    /**@var bool $existRecord  */
    private $existRecord = false;

    /**@var string $orderResNum  */
    private $orderResNum;

    /**@var Order $order  */
    private $order;

    /**@var IModelBaseList<ModelBasket> $listBasket  */
    private $listBasket;

    /**@var ModelInfoPriceBasket $infoPrice  */
    private $infoPrice;

    /**@var IModelBaseList<ResultVerifyPaymentModel> $listPayment  */
    private $listPayment;

    /**@var bool $existSuccessPayment  */
    private $existSuccessPayment = false;

    /**@var ResultVerifyPaymentModel $infoPayment  */
    private $infoPayment;

    /**@var string $codeOff  */
    private $codeOff="";

    /**@var int $codeOffPrice  */
    private $codeOffPrice=0;

    /**@var int $userId  */
    private $userId=0;

    /**@var string $userFullName  */
    private $userFullName="";



    //---------------------------------------------------------------

    function __construct()
    {
        $this->listBasket = new ModelBaseList(ModelBasket::class);
        $this->infoPrice = new ModelInfoPriceBasket();
        $this->listPayment = new ModelBaseList(ResultVerifyPaymentModel::class);
        $this->infoPayment = new ResultVerifyPaymentModel();
    }





    //---------------------------------------------------------------

    /**
     * @return bool
     */
    public function isExistRecord(): bool
    {
        return $this->existRecord;
    }

    /**
     * @param bool $existRecord
     */
    public function setExistRecord(bool $existRecord): void
    {
        $this->existRecord = $existRecord;
    }





    /**
     * @return string
     */
    public function getOrderResNum(): string
    {
        return $this->orderResNum;
    }

    /**
     * @param string $orderResNum
     */
    public function setOrderResNum(string $orderResNum): void
    {
        $this->orderResNum = $orderResNum;
    }





    /**
     * @return Order
     */
    public function getOrder(): Order
    {
        return $this->order;
    }

    /**
     * @param Order $order
     */
    public function setOrder(Order $order): void
    {
        $this->order = $order;
    }














    /**
     * @return IModelBaseList
     */
    public function getListBasket()
    {
        return $this->listBasket;
    }


    /**
     * @param ModelBaseList $listBasket
     */
    public function setListBasket($listBasket)
    {
        $this->listBasket = $listBasket;
    }





    /**
     * @return IModelBaseList
     */
    public function getListPayment(): IModelBaseList
    {
        return $this->listPayment;
    }

    /**
     * @param ModelBaseList $listPayment
     */
    public function setListPayment(ModelBaseList $listPayment): void
    {
        $this->listPayment = $listPayment;
    }




    /**
     * @return ModelInfoPriceBasket
     */
    public function getInfoPrice() :ModelInfoPriceBasket
    {
        return $this->infoPrice;
    }

    /**
     * @param ModelInfoPriceBasket $infoPrice
     */
    public function setInfoPrice(ModelInfoPriceBasket $infoPrice)
    {
        $this->infoPrice = $infoPrice;
    }






    /**
     * @return bool
     */
    public function isExistSuccessPayment(): bool
    {
        return $this->existSuccessPayment;
    }

    /**
     * @param bool $existSuccessPayment
     */
    public function setExistSuccessPayment(bool $existSuccessPayment): void
    {
        $this->existSuccessPayment = $existSuccessPayment;
    }




    /**
     * @return ResultVerifyPaymentModel
     */
    public function getInfoPayment() :ResultVerifyPaymentModel
    {
        return $this->infoPayment;
    }

    /**
     * @param ResultVerifyPaymentModel $infoPayment
     */
    public function setInfoPayment(ResultVerifyPaymentModel $infoPayment)
    {
        $this->infoPayment = $infoPayment;
    }




    /**
     * @return string
     */
    public function getCodeOff()
    {
        return $this->codeOff;
    }

    /**
     * @param string $codeOff
     */
    public function setCodeOff( $codeOff)
    {
        $this->codeOff = $codeOff;
    }



    /**
     * @return int
     */
    public function getCodeOffPrice()
    {
        return $this->codeOffPrice;
    }

    /**
     * @return string
     */
    public function getCodeOffPriceText()
    {
        return persianPriceFormat($this->codeOffPrice);
    }

    /**
     * @return string
     */
    public function getCodeOffPriceTextPass()
    {
        return $this->getCodeOffPriceText(). " " . Config::get("app.passPrice");
    }

    /**
     * @param int $codeOffPrice
     */
    public function setCodeOffPrice( $codeOffPrice)
    {
        $this->codeOffPrice = $codeOffPrice;
    }








    /**
     * @return int
     */
    public function getUserId(): int
    {
        return $this->userId;
    }

    /**
     * @param int $userId
     */
    public function setUserId(int $userId): void
    {
        $this->userId = $userId;
    }







    /**
     * @return string
     */
    public function getUserFullName(): string
    {
        return $this->userFullName;
    }

    /**
     * @param string $userFullName
     */
    public function setUserFullName(string $userFullName): void
    {
        $this->userFullName = $userFullName;
    }







}
