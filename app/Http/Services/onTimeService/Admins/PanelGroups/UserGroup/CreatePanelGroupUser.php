<?php

namespace App\Http\Services\onTimeService\Admins\PanelGroups\UserGroup;

use App\Http\Services\onTimeService\Admins\CreatePanelGroupAdminService;

class CreatePanelGroupUser extends CreatePanelGroupAdminService
{
    public static $panelGroupName = "user";

    public function __construct()
    {
        $this->setPanelGroupTitleEn();
        $this->setPanelGroupTitle("مدیریت کاربران");
        $this->insertInTablePanelGroup();
    }
}
