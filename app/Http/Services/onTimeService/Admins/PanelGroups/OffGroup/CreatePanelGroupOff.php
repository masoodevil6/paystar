<?php
namespace App\Http\Services\onTimeService\Admins\PanelGroups\OffGroup;

use App\Http\Services\onTimeService\Admins\CreatePanelGroupAdminService;

class CreatePanelGroupOff extends CreatePanelGroupAdminService
{
    public static $panelGroupName = "off";

    public function __construct()
    {
        $this->setPanelGroupTitleEn();
        $this->setPanelGroupTitle("مدیریت تخفتفات");
        $this->insertInTablePanelGroup();
    }
}
