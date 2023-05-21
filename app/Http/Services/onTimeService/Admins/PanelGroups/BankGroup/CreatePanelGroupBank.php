<?php

namespace App\Http\Services\onTimeService\Admins\PanelGroups\BankGroup;

use App\Http\Services\onTimeService\Admins\CreatePanelGroupAdminService;

class CreatePanelGroupBank extends CreatePanelGroupAdminService
{
    public static $panelGroupName = "bank";

    public function __construct()
    {
        $this->setPanelGroupTitleEn();
        $this->setPanelGroupTitle("مدیریت بانک ها");
        $this->insertInTablePanelGroup();
    }
}
