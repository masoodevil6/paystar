<?php

namespace App\Http\Services\onTimeService\Admins\PanelGroups\UserGroup;

use App\Http\Services\onTimeService\Admins\CreatePanelAdminService;

class CreatePanelUserPanelGroupUser extends CreatePanelAdminService
{
    public static $panelName = "users";

    public function __construct()
    {
        $this->setPanelGroupName();
        $this->setPanelIcon("fa fa-user");
        $this->setPanelName("کاربران");
        $this->setPanelLink("admin.users.user.index");
        $this->insertInTablePanel();
    }
}
