<?php

namespace App\Http\Services\onTimeService\Admins\PanelGroups\OrderGroup;

use App\Http\Services\onTimeService\Admins\CreatePanelAdminService;

class CreatePanelOrderInPanelGroupOrder extends CreatePanelAdminService
{
    public static $panelName = "orders";

    public function __construct()
    {
        $this->setPanelGroupName();
        $this->setPanelIcon("fa fa-shopping-cart");
        $this->setPanelName("سفارشات ها");
        $this->setPanelLink("admin.Orders.order.index");
        $this->insertInTablePanel();
    }

}
