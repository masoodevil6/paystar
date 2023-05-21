<?php
namespace App\Http\Services\onTimeService\Admins\PanelGroups\OrderGroup;

use App\Http\Services\onTimeService\Admins\CreatePanelGroupAdminService;

class CreatePanelGroupOrder extends CreatePanelGroupAdminService
{
    public static $panelGroupName = "order";

    public function __construct()
    {
        $this->setPanelGroupTitleEn();
        $this->setPanelGroupTitle("مدیریت سفارشات");
        $this->insertInTablePanelGroup();
    }
}
