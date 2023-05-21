<?php
namespace App\Repositories\ModelRepositories\Users;

use App\Http\Services\onTimeService\Images\ImageService;
use App\Models\Users\Otp;
use App\Models\Users\User;
use App\Repositories\ContextRepository;
use App\Repositories\InterFaceRepositories\Users\IUserRepository;
use App\Repositories\ModelRepositories\BaseRepository;
use Carbon\Carbon;
use CKSource\CKFinder\Filesystem\Path;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

/**
 * @template-extends BaseRepository<User>
 * @template-implements  IUserRepository<User>
 */
class UserRepository extends BaseRepository implements IUserRepository {

    protected $pathUser="";
    protected $directoryUserFactors="";
    protected $directoryUserLogo="";
    protected $directoryUserMohr="";

    protected $periodCookieBasket = 7;


    protected $pathTest;
    protected $directoryTestFile;
    protected $directoryTestLogo;
    protected $directoryTestMohr;
    protected $fileTestLogo;
    protected $fileTestMohr;

    public function __construct()
    {
        parent::__construct(new User());
        if (Auth::check() || Auth::guard("api")->check()){

            $this->pathUser = "users/".$this->GetUserAuthId();

            $this->directoryUserFactors = "/factors/";
            $this->directoryUserLogo = "/logo/";
            $this->directoryUserMohr = "/mohr/";

            $this->pathTest = "/test";
            $this->directoryTestFile = $this->pathTest.$this->directoryUserFactors;
            $this->directoryTestLogo = $this->pathTest.$this->directoryUserLogo;
            $this->directoryTestMohr = $this->pathTest.$this->directoryUserMohr;
            $this->fileTestLogo = $this->directoryTestLogo."test.png";
            $this->fileTestMohr = $this->directoryTestMohr."test.png";

            //$this->fileTestLogo = "/test/logo/test.png";
            //$this->fileTestMohr = "/test/mohr/test.png";
        }
    }

    /**
     * @inheritDoc
     */
    function GetUserWithEmail(string $userEmail)
    {
        return $this->model->where("email" , $userEmail)->first();
    }

    /**
     * @inheritDoc
     */
    function GetUserWithPhone(string $userPhone)
    {
        return $this->model->where("mobile" , $userPhone)->first();
    }

    /**
     * @inheritDoc
     */
    function UpdateUserInfo(string $userName, string $userFamily, string $cardNum) :bool
    {
        $user = $this->GetUserAuthInfo();
        if (!empty($user)){
            return $this->updateResult(
                $user ,
                [
                    "name" => $userName ,
                    "family" => $userFamily ,
                    "cart_number" => $cardNum ,
                ]
            );
        }
        return false;
    }

    /**
     * @inheritDoc
     */
    function UpdateUserEmailOrPhone(Otp $otp): bool
    {
        if ($this->GetUserAuthId() == $otp->user_id){
            $type = $otp->type;
            $input = $otp->input_login;
            $user = $this->GetUserAuthInfo();

            $data = [];
            if ($type == 0){
                $data["mobile"] = $input;
            }
            else if ($type == 1){
                $data["email"] = $input;
            }
            $data["activation"] = 1;

            ContextRepository::OtpRepository()->UpdateUsedTokenOtp($otp);
            $this->updateResult($user , $data);

            return true;
        }
        return false;
    }



    /**
     * @inheritDoc
     */
    function SyncPanelUserAdmin(string  $user_email , int $adminId , int $AdminStatus , string $adminPassword="fa1401")
    {
        $user = $this->GetUserWithEmail($user_email);
        $user->admins()->sync(
            [
                $adminId =>[
                    "status"=> $AdminStatus ,
                    "password" => Hash::make($adminPassword)
                ]
            ]
        );
    }

    /**
     * @inheritDoc
     */
    function UpdatePanelUserAdmin(User $user , int $adminId , int $AdminStatus)
    {
        $user->admins()->updateExistingPivot($user->admins->get(0) , [ "admin_id" => $adminId , "status"=> $AdminStatus]);
    }

    /**
     * @inheritDoc
     */
    function DetachAllPanelUserAdmin(int $userId)
    {
        $user = $this->getResult($userId);
        $this->DetachPanelUserAdmin($user);
    }

    /**
     * @inheritDoc
     */
    function DetachPanelUserAdmin(User $user)
    {
        $user->admins()->detach();
    }




    /**
     * @inheritDoc
     */
    function SearchUser(string $userName = "" , $numInPage=15)
    {
        if ($userName != ""){
            $this->model = $this->addSearcher("CONCAT(`name`, ' ', `family`)" , $userName);
        }

        return $this->model->paginate($numInPage);
    }

    /**
     * @inheritDoc
     */
    function SearchUserWithEmail(string $userEmail = "" , $numInPage=15)
    {
        if ($userEmail != ""){
            $this->model = $this->addSearcher("email" , $userEmail);
        }

        return $this->model->select(["id" , "email" , "name" , "family"])->paginate($numInPage);
    }

    /**
     * @inheritDoc
     */
    function SearchUserFirstWithEmail(string $userEmail = "")
    {
        return $this->model->select(["id" , "email"  , "name" , "family"])->where("email" , $userEmail) ->first();
    }





    /**
     * @inheritDoc
     */
    function GetUserAuthInfo()
    {
        if (Auth::guard("web")->check()){
            return Auth::user();
        }
        else if (Auth::guard("api")->check()){
            return Auth::guard("api")->user()->user;
        }
        return null;
    }

    /**
     * @inheritDoc
     */
    function GetUserAuthId()
    {
        $user = $this->GetUserAuthInfo();
        if (!empty($user) && $user != null){
            return $user->id;
        }

        return null;
    }

    /**
     * @inheritDoc
     */
    function LogoutAuthUser()
    {
        if (Auth::check()){
            Auth::logout();
        }
        else if (Auth::guard("api")->check()){
            Auth::guard("api")->logout();
        }
    }

    /**
     * @inheritDoc
     */
    function deleteDeActiveClients(){
        $this->model
            ->where("activation" , 0)
            ->where("created_at" , "<=" , Carbon::now()->subDays(1)->toDateTimeString())
            ->delete();
    }



    /**
     * @inheritDoc
     */
    function getCookiePeriod()
    {
        return $this->periodCookieBasket;
    }

    /**
     * @inheritDoc
     */
    function getCookieForBasket()
    {
        if (Cookie::has("basket")){
            return Cookie::get("basket");
        }
        else{
            $value = time();
            $time = $this->periodCookieBasket;
            $cookie = $value;
            Cookie::queue(Cookie::make("basket" , $value , $time*12*60));
            return $cookie;
        }
    }





    /**
     * @inheritDoc
     */
    function GetUserPanelAuthAdminInfo($user)
    {
        return $user->admins()->first();
    }

    /**
     * @inheritDoc
     */
    function GetUserPasswordAuthPanelAdmin($panel)
    {
        return $panel->pivot->password;
    }

    /**
     * @inheritDoc
     */
    function GetUserMainAuthPanelAdmin($panel)
    {
        return $panel->pivot->main;
    }







    /**
     * @inheritDoc
     */
    function CheckExistImageUserLogo(){
        $userLogo = $this->getFileNameLogo();
        if (!empty($userLogo) && Storage::exists($userLogo)){
            return true;
        }
        return false;
    }

    /**
     * @inheritDoc
     */
    function GetImageUserLogo()
    {
        if ($this->CheckExistImageUserLogo()){
            return Storage::download($this->getFileNameLogo());
        }
        return null;
    }

    /**
     * @inheritDoc
     */
    function UploadImageUserLogo($logoFile)
    {
        $resultFile = $this->uploadUserImageServer($logoFile , "logo");
        if (!empty($resultFile)){
            $this->DeleteImageUserLogo();
            $this->updateResult($this->GetUserAuthInfo() , [
                "logo" => $resultFile
            ]);
            $this->DeleteUserFolderInPublicDirectory();
            $this->DeleteLogoOrMohrExpiredInPath("logo" , $resultFile);
        }
    }

    /**
     * @inheritDoc
     */
    function DeleteImageUserLogo()
    {
        $locationLogo = $this->getFileNameLogo();
        if (!empty($locationLogo)){
            $this->updateResult($this->GetUserAuthInfo() , [
                "logo" => null
            ]);

            if (Storage::exists($locationLogo)){
                Storage::delete($locationLogo);
            }
        }
    }






    /**
     * @inheritDoc
     */
    function CheckExistImageUserMohr(){
        $userMohr = $this->getFileNameMohr();
        if (!empty($userMohr) && Storage::exists($userMohr)){
            return true;
        }
        return false;
    }

    /**
     * @inheritDoc
     */
    function GetImageUserMohr()
    {
        if ($this->CheckExistImageUserMohr()){
            return Storage::download($this->getFileNameMohr());
        }
        return null;
    }

    /**
     * @inheritDoc
     */
    function UploadImageUserMohr($mohrFile)
    {
        $resultFile = $this->uploadUserImageServer($mohrFile , "mohr");
        if (!empty($resultFile)){
            $this->DeleteImageUserMohr();
            $this->updateResult($this->GetUserAuthInfo() , [
                "mohr" => $resultFile
            ]);
            $this->DeleteUserFolderInPublicDirectory();
            $this->DeleteLogoOrMohrExpiredInPath("mohr" , $resultFile);
        }
    }

    /**
     * @inheritDoc
     */
    function DeleteImageUserMohr()
    {
        $locationMohr = $this->getFileNameMohr();
        if (!empty($locationMohr)){
            $this->updateResult($this->GetUserAuthInfo() , [
                "mohr" => null
            ]);

            if (Storage::exists($locationMohr)){
                Storage::delete($locationMohr);
            }
        }
    }





    /**
     * @inheritDoc
     */
    public function getPathUser()
    {
        return $this->pathUser;
    }

    /**
     * @inheritDoc
     */
    public function getDirectoryUserFactors()
    {
        return $this->directoryUserFactors;
    }

    /**
     * @inheritDoc
     */
    public function getDirectoryUserLogo()
    {
        return $this->directoryUserLogo;
    }

    /**
     * @inheritDoc
     */
    public function getDirectoryUserMohr()
    {
        return $this->directoryUserMohr;
    }

    /**
     * @inheritDoc
     */
    private function getLocationDirUserLogo(){
        return $this->getPathUser().$this->getDirectoryUserLogo();
    }

    /**
     * @inheritDoc
     */
    private function getLocationDirUserMohr(){
        return $this->getPathUser().$this->getDirectoryUserMohr();
    }



    /**
     * @inheritDoc
     */
    public function getPathTest()
    {
        return $this->pathTest;
    }

    /**
     * @inheritDoc
     */
    public function getDirectoryTestFile()
    {
        return $this->directoryTestFile;
    }

    /**
     * @inheritDoc
     */
    public function getDirectoryTestLogo()
    {
        return $this->directoryTestLogo;
    }

    /**
     * @inheritDoc
     */
    public function getDirectoryTestMohr()
    {
        return $this->directoryTestMohr;
    }

    /**
     * @inheritDoc
     */
    public function getFileTestLogo()
    {
        return $this->fileTestLogo;
    }

    /**
     * @inheritDoc
     */
    public function getFileTestMohr()
    {
        return $this->fileTestMohr;
    }





    /**
     * @inheritDoc
     */
    public function uploadUserImageServer($fileImage , $type="" , $base64=false){

        $imageService = new ImageService();

        $imageService->setExclusiveDirectory($this->getPathUser());

        if ($type == "logo"){
            $imageService->setImageDirectory($this->getDirectoryUserLogo());
        }
        else if ($type == "mohr"){
            $imageService->setImageDirectory($this->getDirectoryUserMohr());
        }

        if ($base64){
            return $imageService -> saveFromBase64($fileImage , "png" , false , "storage");
        }
        return $imageService -> save($fileImage , false , "storage");
    }

    /**
     * @inheritDoc
     */
    public function DeleteUserFolderInPublicDirectory(){
        $imageService = new ImageService();
        $imageService->deleteDirectoryAndFiles(public_path($this->getPathUser()));
    }

    /**
     * @return  void
     */
    private function DeleteLogoOrMohrExpiredInPath($type , $newFile){
        $directory = null;
        if ($type == "logo"){
            $directory =  $this->getLocationDirUserLogo();
        }
        else if ($type == "mohr"){
            $directory =  $this->getLocationDirUserMohr();
        }

        if ($directory != null || $directory != ""){
            $files = Storage::files($directory);
            foreach ($files as $itemFile){
                if ($itemFile != $newFile){
                    Storage::delete($itemFile);
                }
            }
        }
    }



    /**
     * @inheritDoc
     */
    function CopyFileLogoNameToDirectory()
    {
        $userImageLogo = $this->getFileNameLogo();
        if (!empty($userImageLogo)){
            $newFile = $this->getPathUser().$this->getDirectoryUserLogo().time().getMimeFile($userImageLogo);
            Storage::copy($userImageLogo , $newFile);
            return $newFile;
        }
        return null;
    }

    /**
     * @inheritDoc
     */
    function CopyFileMohrNameToDirectory()
    {
        $userImageMohr = $this->getFileNameMohr();
        if (!empty($userImageMohr)){
            $newFile = $this->getPathUser().$this->getDirectoryUserMohr().time().getMimeFile($userImageMohr);
            Storage::copy($userImageMohr , $newFile);
            return $newFile;
        }
        return null;
    }










    //// --------------------------------------

    /**
     * @return  string
     */
    private function getFileNameLogo(){
        return $this->GetUserAuthInfo()->logo;
    }

    /**
     * @return  string
     */
    private function getFileNameMohr(){
        return $this->GetUserAuthInfo()->mohr;
    }



}
