<?php
namespace App\Tools\Models\Purchase;
use Illuminate\Support\Collection;



class InfoPurchase {

    /**@var string $orderId*/
    private $orderId;

    /**@var string $purchaseToken*/
    private $purchaseToken;

    /**@var string $payload*/
    private $payload;

    /**@var string $packageName*/
    private $packageName;

    /**@var int $purchaseState*/
    private $purchaseState;

    /**@var int $purchaseTime*/
    private $purchaseTime;

    /**@var string $productId*/
    private $productId;



    /**
     * @return string
     */
    public function getOrderId()
    {
        return $this->orderId;
    }

    /**
     * @param string $orderId
     */
    public function setOrderId($orderId): void
    {
        $this->orderId = $orderId;
    }

    /**
     * @return string
     */
    public function getPurchaseToken()
    {
        return $this->purchaseToken;
    }

    /**
     * @param string $purchaseToken
     */
    public function setPurchaseToken($purchaseToken): void
    {
        $this->purchaseToken = $purchaseToken;
    }

    /**
     * @return string
     */
    public function getPayload()
    {
        return $this->payload;
    }

    /**
     * @param string $payload
     */
    public function setPayload($payload): void
    {
        $this->payload = $payload;
    }

    /**
     * @return string
     */
    public function getPackageName()
    {
        return $this->packageName;
    }

    /**
     * @param string $packageName
     */
    public function setPackageName($packageName): void
    {
        $this->packageName = $packageName;
    }

    /**
     * @return int
     */
    public function getPurchaseState()
    {
        return $this->purchaseState;
    }

    /**
     * @param int $purchaseState
     */
    public function setPurchaseState($purchaseState): void
    {
        $this->purchaseState = $purchaseState;
    }

    /**
     * @return int
     */
    public function getPurchaseTime()
    {
        return $this->purchaseTime;
    }

    /**
     * @param int $purchaseTime
     */
    public function setPurchaseTime($purchaseTime): void
    {
        $this->purchaseTime = $purchaseTime;
    }

    /**
     * @return string
     */
    public function getProductId()
    {
        return $this->productId;
    }

    /**
     * @param string $productId
     */
    public function setProductId($productId): void
    {
        $this->productId = $productId;
    }



}
