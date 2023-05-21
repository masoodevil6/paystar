<?php

namespace App\Http\Services\onTimeService\Admins\PanelGroups\AdminGroup;

use App\Http\Services\onTimeService\Admins\CreatePanelGroupAdminService;

class CreatePanelGroupAdmin extends CreatePanelGroupAdminService
{
    public static $panelGroupName = "admin";

    public function __construct()
    {
        $this->setPanelGroupTitleEn();
        $this->setPanelGroupTitle("مدیریت ادمین ها");
        $this->insertInTablePanelGroup();
    }
}
