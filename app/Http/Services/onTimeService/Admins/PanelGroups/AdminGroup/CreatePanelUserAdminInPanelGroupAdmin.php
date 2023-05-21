<?php

namespace App\Http\Services\onTimeService\Admins\PanelGroups\AdminGroup;

use App\Http\Services\onTimeService\Admins\CreatePanelAdminService;

class CreatePanelUserAdminInPanelGroupAdmin extends CreatePanelAdminService
{
    public static $panelName = "users";

    public function __construct()
    {
        $this->setPanelGroupName();
        $this->setPanelIcon("fa fa-users");
        $this->setPanelName("ادمین ها");
        $this->setPanelLink("admin.panel.user-admin.index");
        $this->insertInTablePanel();
    }

}
