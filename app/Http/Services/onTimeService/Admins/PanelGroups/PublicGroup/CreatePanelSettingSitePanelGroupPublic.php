<?php

namespace App\Http\Services\onTimeService\Admins\PanelGroups\PublicGroup;

use App\Http\Services\onTimeService\Admins\CreatePanelAdminService;

class CreatePanelSettingSitePanelGroupPublic extends CreatePanelAdminService
{
    public static $panelName = "settings";

    public function __construct()
    {
        $this->setPanelGroupName();
        $this->setPanelIcon("fas fa-cog");
        $this->setPanelName("تنظیمات عمومی");
        $this->setPanelLink("admin.public.setting.index");
        $this->insertInTablePanel();
    }

}
