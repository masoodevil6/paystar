<?php
namespace App\Http\Services\onTimeService\Admins\PanelGroups\OffGroup;

use App\Http\Services\onTimeService\Admins\CreatePanelAdminService;

class CreatePanelOffStatusInPanelGroupOff extends CreatePanelAdminService
{
    public static $panelName = "code-off-status";

    public function __construct()
    {
        $this->setPanelGroupName();
        $this->setPanelIcon("fa fa-sun-o");
        $this->setPanelName("شرط تولید کد");
        $this->setPanelLink("admin.offs.code-off-status.index");
        $this->insertInTablePanel();
    }

}
