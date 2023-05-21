<?php

namespace App\Http\Services\onTimeService\Admins\PanelGroups\SubscribeGroup;


use App\Http\Services\onTimeService\Admins\CreatePanelGroupAdminService;

class CreatePanelGroupSubscribe extends CreatePanelGroupAdminService
{
    public static $panelGroupName = "subscribe";

    public function __construct()
    {
        $this->setPanelGroupTitleEn();
        $this->setPanelGroupTitle("مدیریت اشتراک");
        $this->insertInTablePanelGroup();
    }
}
