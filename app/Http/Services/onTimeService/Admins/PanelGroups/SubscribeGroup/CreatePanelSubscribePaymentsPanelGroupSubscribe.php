<?php

namespace App\Http\Services\onTimeService\Admins\PanelGroups\SubscribeGroup;

use App\Http\Services\onTimeService\Admins\CreatePanelAdminService;

class CreatePanelSubscribePaymentsPanelGroupSubscribe extends CreatePanelAdminService
{
    public static $panelName = "payments";

    public function __construct()
    {
        $this->setPanelGroupName();
        $this->setPanelIcon("fa fa-usd");
        $this->setPanelName("تراکنش های اشتراک");
        $this->setPanelLink("admin.subscribes.subscribe-payment.index");
        $this->insertInTablePanel();
    }
}
