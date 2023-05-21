<?php

namespace App\Http\Controllers\Auth\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\Admin\LoginAdminRequest;
use App\Http\Services\onTimeService\RedirectRoute\RedirectRouteService;

use App\Providers\RouteServiceProvider;
use App\Repositories\ContextRepository;
use Illuminate\Support\Facades\Hash;
use function Symfony\Component\Mime\Header\get;

class LoginAdminPanelCustomerController extends Controller
{

    private $adminUserRepository;
    private $userRepository;

    public function __construct()
    {
        $this->adminUserRepository = ContextRepository::AdminUserRepository();
        $this->userRepository = ContextRepository::UserRepository();
    }



    public function formLogin(){

        $isMaxRequest = 0;
        if (isset($_GET["is-max-request"])){
            $isMaxRequest = $_GET["is-max-request"];
        }

        $user = $this->userRepository->GetUserAuthInfo();

        return view("admin.auth.index" , compact("user" , "isMaxRequest"));
    }



    public function commitLogin(LoginAdminRequest $request){

        $email = $request->get("userEmail");
        $myPassword = $request->get("password");

        $user = $this->userRepository->GetUserWithEmail($email);

        $panel = $this->userRepository->GetUserPanelAuthAdminInfo($user);

        if (!empty($panel)){
            $password =  $this->userRepository->GetUserPasswordAuthPanelAdmin($panel);

            if (Hash::check($myPassword , $password)){
                $this->adminUserRepository->LoginUserAdmin($user->id);
                return redirect()->route("admin.home");
            }
            else{
                return RedirectRouteService::setMsgResultText("پسورد وارد شده صحیح نمی باشد ...")
                    ->doRedirectRouteErrorResult()
                    ->setRouteRedirect(route("admin-auth.form-login"))
                    ->doRedirect();
            }
        }
        else{
           return redirect()->route("home");
        }
    }




    public function logout(){
        ContextRepository::AdminUserRepository()->LogoutAuthAdminPanel();
        return redirect()->to("/");
    }



}
