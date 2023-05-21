<?php

namespace App\Http\Controllers\Admin\Home;


use App\Http\Controllers\Admin\MainAdminController;
use App\Repositories\ContextRepository;


class HomeAdminController extends MainAdminController
{

    function __construct()
    {
        parent::__construct(route("admin.home"));
    }

    public function index(){

        $nav = [
            "part"=> "",
            "navigation" =>[]
        ];

        $panelSearch="";
        if (isset($_GET["search"])){
            $panelSearch = $_GET["search"];
        }
        $panels = ContextRepository::AdminUserRepository()->SearchPanelAdmin($panelSearch);


        return view("admin.home.index" , compact("nav" , "panels" , "panelSearch"));
    }

}
