<?php
namespace App\Repositories\InterFaceRepositories\Users;

use App\Models\Users\Otp;
use App\Repositories\InterFaceRepositories\IBaseRepository;

/**
 * @template T
 * @template-extends IBaseRepository<T>
 */
interface IOtpRepository extends IBaseRepository {


    /**
     * @return  bool
     */
    function CheckExistRequestInPeriodMaxTimeLast($inputLogin , $type);


    /**
     * @return  array
     */
    function createTokenOTP($userId , $inputLogin , $type , $checkStatus=false);

    /**
     * @return  T
     */
    function checkLastLogin($token);

    /**
     * @return  T
     */
    function existOtpRequest($token , $userId=0 , $checkTime=true);

    /**
     * @return  T
     */
    function getTypeOtp($typeTitle);

    /**
     * @return  bool
     */
    function getTypeValueOtp($typeId);

    /**
     * @return  int
     */
    function getMaxTimeRequest();

    /**
     * @return  int
     */
    function getExpireLoginWithTokenApi();


    /**
     * @return  int
     */
    function UpdateUsedTokenOtp(Otp $otp) :bool ;

    /**
     * @return  void
     */
    function deleteOtpCodeExpiredLastDay();


}
