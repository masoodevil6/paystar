<?php

namespace App\Http\Services\onTimeService\Admins\PanelGroups\AdminGroup;

use App\Http\Services\onTimeService\Admins\CreatePanelAdminService;

class CreatePanelPanelsInPanelGroupAdmin extends CreatePanelAdminService
{
    public static $panelName = "panels";

    public function __construct()
    {
        $this->setPanelGroupName();
        $this->setPanelIcon("fa fa-address-card");
        $this->setPanelName("پنل ها");
        $this->setPanelLink("admin.panel.admin.index");
        $this->insertInTablePanel();
    }

}
