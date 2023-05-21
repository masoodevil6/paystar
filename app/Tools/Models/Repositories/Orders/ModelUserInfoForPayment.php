<?php
namespace App\Tools\Models\Repositories\Orders;

class ModelUserInfoForPayment{


    private $userId = 0;
    private $userFullName = "";
    private $userMobile = "";
    private $userEmail = "";

    /**
     * @return int
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * @param int $userId
     */
    public function setUserId( $userId)
    {
        $this->userId = $userId;
    }

    /**
     * @return string
     */
    public function getUserFullName()
    {
        return $this->userFullName;
    }

    /**
     * @param string $userFullName
     */
    public function setUserFullName( $userFullName)
    {
        $this->userFullName = $userFullName;
    }

    /**
     * @return string
     */
    public function getUserMobile()
    {
        return $this->userMobile;
    }

    /**
     * @param string $userMobile
     */
    public function setUserMobile( $userMobile)
    {
        $this->userMobile = $userMobile;
    }

    /**
     * @return string
     */
    public function getUserEmail()
    {
        return $this->userEmail;
    }

    /**
     * @param string $userEmail
     */
    public function setUserEmail( $userEmail)
    {
        $this->userEmail = $userEmail;
    }





}