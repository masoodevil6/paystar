<?php
namespace App\Repositories\ModelRepositories\Panels;

use App\Models\Panel\AdminUser;
use App\Repositories\InterFaceRepositories\Panels\IAdminUserRepository;
use App\Repositories\ModelRepositories\BaseRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

/**
 * @template-extends BaseRepository<AdminUser>
 * @template-implements  IAdminUserRepository<AdminUser>
 */
class AdminUserRepository extends BaseRepository implements IAdminUserRepository {

    private $guardPanelAdmin = "admin";
    public function __construct()
    {
        parent::__construct(new AdminUser());
    }

    /**
     * @inheritDoc
     */
    function getLoginClientToPanelAdmin()
    {
        return $this->model
            ->select("admins.id")
            ->where("admin_user.user_id" , Auth::id())
            ->join("admins" , "admin_user.admin_id" , "=" , "admins.id")
            ->first();
    }


    /**
     * @inheritDoc
     */
    function LoginUserAdmin(int $id)
    {
        $panelClass = $this->model->where("user_id" , $id)->first();
        Auth::guard("admin")->login($panelClass);
    }

    /**
     * @inheritDoc
     */
    function GetUserAdminAuth(){
        return Auth::guard($this->guardPanelAdmin)->user();
    }

    /**
     * @inheritDoc
     */
    function GetUserIdAdminAuth(){
        return Auth::guard($this->guardPanelAdmin)->id();
    }

    /**
     * @inheritDoc
     */
    function GetPanelUserAdminAuth($adminUser)
    {
        return $adminUser->admin;
    }

    /**
     * @inheritDoc
     */
    function GetEmailAdminAuth($password)
    {
        $adminPanel = $this->GetUserAdminAuth();
        if (Hash::check($password , $adminPanel->password)){

            return $adminPanel->user -> email;
        }
        return null;
    }

    /**
     * @inheritDoc
     */
    function LogoutAuthAdminPanel()
    {
        if (Auth::guard($this->guardPanelAdmin)->check()){
            Auth::guard($this->guardPanelAdmin)->logout();
        }
    }

    /**
     * @inheritDoc
     */
    function SearchAdminUser($userName = "", $userEmail = "", $panelSearcher = 0, $numInPage = 15)
    {
        if ($userName != "" && $userEmail != ""){
            $this->model = $this->model->join('users', function($join) use ($userName , $userEmail){
                $join->on('admin_user.user_id', "=", 'users.id');
                $join->where(function ($where) use ($userName) {
                    $where
                        ->where(DB::raw("CONCAT(users.`name`, ' ', users.`family`)")  , "like" , $userName."%")
                        ->orWhere(DB::raw("CONCAT(users.`name`, ' ', users.`family`)")  , "like" , "%".$userName)
                        ->orWhere(DB::raw("CONCAT(users.`name`, ' ', users.`family`)")  , "like" , "%".$userName."%")
                        ->orWhere(DB::raw("CONCAT(users.`name`, ' ', users.`family`)")  , "like" , $userName);
                });
                $join->where(function ($where) use ($userEmail) {
                    $where
                        ->where("users.email"  , "like" , $userEmail."%")
                        ->orWhere("users.email"  , "like" , "%".$userEmail)
                        ->orWhere("users.email"  , "like" , "%".$userEmail."%")
                        ->orWhere("users.email" , "like" , $userEmail);
                });
            });
        }
        else if ($userName != ""){
            $this->model = $this->model->join('users', function($join) use ($userName){
                $join->on('admin_user.user_id', "=", 'users.id');
                $join
                    ->where(DB::raw("CONCAT(users.`name`, ' ', users.`family`)")  , "like" , $userName."%")
                    ->orWhere(DB::raw("CONCAT(users.`name`, ' ', users.`family`)")  , "like" , "%".$userName)
                    ->orWhere(DB::raw("CONCAT(users.`name`, ' ', users.`family`)")  , "like" , "%".$userName."%")
                    ->orWhere(DB::raw("CONCAT(users.`name`, ' ', users.`family`)")  , "like" , $userName);

            });
        }
        else if ($userEmail != ""){
            $this->model = $this->model->join('users', function($join) use ($userEmail){
                $join->on('admin_user.user_id', "=", 'users.id');
                $join
                    ->where("users.email"  , "like" , $userEmail."%")
                    ->orWhere("users.email"  , "like" , "%".$userEmail)
                    ->orWhere("users.email"  , "like" , "%".$userEmail."%")
                    ->orWhere("users.email"  , "like" , $userEmail);
            });
        }
        else{
            $this->model = $this->model->join('users','admin_user.user_id', "=", 'users.id');
        }

        $this->model = $this->model->join('admins','admin_user.admin_id', "=", 'admins.id');

        if ($panelSearcher > 0){
            $this->model = $this->model->where("admin_id" , $panelSearcher);
        }

        return $this->model->paginate($numInPage);
    }


    /**
     * @inheritDoc
     */
    function SearchPanelAdmin(string $panelName="")
    {
        $admin = $this->GetUserAdminAuth();
        $this->model = $this->model->join('admin_panel' , 'admin_user.admin_id', "=", 'admin_panel.admin_id');

        if ($panelName != ""){
            $this->model = $this->model->join('panels', function($join) use ($panelName){
                $join->on('admin_panel.panel_id', "=", 'panels.id');
                $join
                    ->where("panels.name"  , "like" , $panelName."%")
                    ->orWhere("panels.name"  , "like" , "%".$panelName)
                    ->orWhere("panels.name"  , "like" , "%".$panelName."%")
                    ->orWhere("panels.name"  , "like" , $panelName);
            });
        }
        else{
            $this->model = $this->model->join('panels' , 'admin_panel.panel_id', "=", 'panels.id');
        }

        $this->model = $this->model->join('panel_groups' , 'panels.panel_group_id', "=", 'panel_groups.id');


        $resultPanels = $this->model->where("admin_user.admin_id" , $admin->admin_id)->where("admin_user.status" , 1)->distinct()
            ->get(
                [
                    "panels.id As panel_id" , "panels.icon As panel_icon" , "panels.name As panel_name" , "panels.link As panel_link" ,
                    "panel_groups.id As group_id" , "panel_groups.title As group_title" ,
                ]
            );

        return $this->readyPanels($resultPanels);
    }


    //---------------------------------

    /**
     * @return  array
     */
    private function readyPanels($resultPanels){
        $resultExp = [];

        foreach ($resultPanels As $itemPanel){
            $existGroup = false;
            foreach ($resultExp As $groupPanel){
                if ($itemPanel["group_id"] == $groupPanel["group_id"]){
                    $existGroup = true;
                    break;
                }
            }

            if (!$existGroup){

                $group=[
                    "group_id" => $itemPanel["group_id"] ,
                    "group_title" => $itemPanel["group_title"] ,
                    "panels" => []
                ];

                $group["panels"] = $this->readyPanelsInGroup($group , $resultPanels);

                array_push($resultExp , $group);
            }
        }

        return $resultExp;
    }

    /**
     * @return  array
     */
    private function readyPanelsInGroup($group , $allPanels){

        $resultExp = [];
        foreach ($allPanels As $item){
            if ($item["group_id"] == $group["group_id"]){

                $existPanel = false;
                foreach ($resultExp As $itemPanel){
                    if ($item["panel_id"] == $itemPanel["panel_id"]){
                        $existPanel = true;
                        break;
                    }
                }

                if (!$existPanel){

                    $panel=[
                        "panel_id" => $item["group_id"] ,
                        "panel_icon" => $item["panel_icon"] ,
                        "panel_name" => $item["panel_name"] ,
                        "panel_link" => $item["panel_link"]
                    ];

                    array_push($resultExp , $panel);
                }
            }
        }

        return $resultExp;
    }

}
