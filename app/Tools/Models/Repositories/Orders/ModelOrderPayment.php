<?php
namespace App\Tools\Models\Repositories\Orders;

class ModelOrderPayment{

    private $priceForPayment = 0;
    private $orderId = null;
    private $readyForPayment = false;
    private $userInfo;
    private $paymentDescription= "";
    private $resNum= "";

    function __construct()
    {
        $this->userInfo = new ModelUserInfoForPayment();
    }


    /**
     * @return mixed
     */
    public function getPriceForPayment()
    {
        return $this->priceForPayment;
    }

    /**
     * @param mixed $priceForPayment
     */
    public function setPriceForPayment($priceForPayment)
    {
        $this->priceForPayment = $priceForPayment;
    }



    /**
     * @return null
     */
    public function getOrderId()
    {
        return $this->orderId;
    }

    /**
     * @param null $orderId
     */
    public function setOrderId($orderId)
    {
        $this->orderId = $orderId;
    }




    /**
     * @return bool
     */
    public function isReadyForPayment()
    {
        return $this->readyForPayment;
    }

    /**
     * @param bool $readyForPayment
     */
    public function setReadyForPayment( $readyForPayment)
    {
        $this->readyForPayment = $readyForPayment;
    }





    /**
     * @return array
     */
    public function getUserInfo(): ModelUserInfoForPayment
    {
        return $this->userInfo;
    }

    /**
     * @param array $userInfo
     */
    public function setUserInfo(ModelUserInfoForPayment $userInfo)
    {
        $this->userInfo = $userInfo;
    }




    /**
     * @return string
     */
    public function getPaymentDescription()
    {
        return $this->paymentDescription;
    }

    /**
     * @param string $paymentDescription
     */
    public function setPaymentDescription( $paymentDescription)
    {
        $this->paymentDescription = $paymentDescription;
    }




    /**
     * @return string
     */
    public function getResNum(): string
    {
        return $this->resNum;
    }

    /**
     * @param string $resNum
     */
    public function setResNum(string $resNum): void
    {
        $this->resNum = $resNum;
    }








}
