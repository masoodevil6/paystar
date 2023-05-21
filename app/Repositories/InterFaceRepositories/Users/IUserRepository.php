<?php
namespace App\Repositories\InterFaceRepositories\Users;

use App\Models\Users\Otp;
use App\Models\Users\User;
use App\Repositories\InterFaceRepositories\IBaseRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Symfony\Component\HttpFoundation\StreamedResponse;

/**
 * @template T
 * @template-extends IBaseRepository<T>
 */
interface IUserRepository extends IBaseRepository {
    /**
     * @return  T
     */
    function GetUserWithEmail(string $userEmail);

    /**
     * @return  T
     */
    function GetUserWithPhone(string $userPhone);

    /**
     * @return  bool
     */
    function UpdateUserInfo(string $userName , string $userFamily, string $cardNum) : bool ;

    /**
     * @return  bool
     */
    function UpdateUserEmailOrPhone(Otp $otp) : bool ;



    /**
     * @return  void
     */
    function SyncPanelUserAdmin(string  $user_email , int $adminId , int $AdminStatus , string $adminPassword="fa1401");

    /**
     * @return  void
     */
    function UpdatePanelUserAdmin(User $user , int $adminId , int $AdminStatus);

    /**
     * @return  void
     */
    function DetachAllPanelUserAdmin(int $userId);

    /**
     * @return  void
     */
    function DetachPanelUserAdmin(User $user);



    /**
     * @return  LengthAwarePaginator
     */
    function SearchUser(string $userName="" , $numInPage=15);

    /**
     * @return  LengthAwarePaginator
     */
    function SearchUserWithEmail(string $userEmail="" , $numInPage=15);

    /**
     * @return  T
     */
    function SearchUserFirstWithEmail(string $userEmail="");



    /**
     * @return  T
     */
    function GetUserAuthInfo();

    /**
     * @return  int
     */
    function GetUserAuthId();

    /**
     * @return  void
     */
    function LogoutAuthUser();

    /**
     * @return  void
     */
    function deleteDeActiveClients();





    /**
     * @return  int
     */
    function getCookiePeriod();

    /**
     * @return  string
     */
    function getCookieForBasket();





    /**
     * @return  T
     */
    function GetUserPanelAuthAdminInfo($user);

    /**
     * @return  string
     */
    function GetUserPasswordAuthPanelAdmin($panel);

    /**
     * @return  string
     */
    function GetUserMainAuthPanelAdmin($panel);



    /**
     * @return  bool
     */
    function CheckExistImageUserLogo();

    /**
     * @return  StreamedResponse
     */
    function GetImageUserLogo();

    /**
     * @return  void
     */
    function UploadImageUserLogo($logoFile);

    /**
     * @return  void
     */
    function DeleteImageUserLogo();


    /**
     * @return  bool
     */
    function CheckExistImageUserMohr();

    /**
     * @return  StreamedResponse
     */
    function GetImageUserMohr();

    /**
     * @return  void
     */
    function UploadImageUserMohr($mohrFile);

    /**
     * @return  void
     */
    function DeleteImageUserMohr();




    /**
     * @return  string
     */
    function getPathUser();

    /**
     * @return  string
     */
    function getDirectoryUserFactors();

    /**
     * @return  string
     */
    function getDirectoryUserLogo();

    /**
     * @return  string
     */
    function getDirectoryUserMohr();

    /**
     * @return  string
     */
    function getPathTest();

    /**
     * @return  string
     */
    function getDirectoryTestFile();

    /**
     * @return  string
     */
    function getDirectoryTestLogo();

    /**
     * @return  string
     */
    function getDirectoryTestMohr();

    /**
     * @return  string
     */
    function getFileTestLogo();

    /**
     * @return  string
     */
    function getFileTestMohr();


    /**
     * @return  string
     */
    function uploadUserImageServer($fileImage , $type="" , $base64=false);

    /**
     * @return  void
     */
    function DeleteUserFolderInPublicDirectory();


    /**
     * @return  bool
     */
    function CopyFileLogoNameToDirectory();

    /**
     * @return  bool
     */
    function CopyFileMohrNameToDirectory();

}
