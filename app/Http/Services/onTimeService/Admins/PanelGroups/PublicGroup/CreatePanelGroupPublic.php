<?php

namespace App\Http\Services\onTimeService\Admins\PanelGroups\PublicGroup;

use App\Http\Services\onTimeService\Admins\CreatePanelGroupAdminService;

class CreatePanelGroupPublic extends CreatePanelGroupAdminService
{
    public static $panelGroupName = "public";

    public function __construct()
    {
        $this->setPanelGroupTitleEn();
        $this->setPanelGroupTitle("مدیریت عمومی");
        $this->insertInTablePanelGroup();
    }
}
