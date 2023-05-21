<?php

namespace App\Http\Services\onTimeService\Admins\PanelGroups\SubscribeGroup;

use App\Http\Services\onTimeService\Admins\CreatePanelAdminService;

class CreatePanelSubscribePanelGroupSubscribe extends CreatePanelAdminService
{
    public static $panelName = "subscribes";

    public function __construct()
    {
        $this->setPanelGroupName();
        $this->setPanelIcon("fa fa-credit-card");
        $this->setPanelName("اشتراک ها");
        $this->setPanelLink("admin.subscribes.subscribe.index");
        $this->insertInTablePanel();
    }
}
