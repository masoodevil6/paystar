<?php

namespace App\Http\Services\onTimeService\Admins\PanelGroups\BankGroup;

use App\Http\Services\onTimeService\Admins\CreatePanelAdminService;

class CreatePanelBankInPanelGroupBank extends CreatePanelAdminService
{
    public static $panelName = "banks";

    public function __construct()
    {
        $this->setPanelGroupName();
        $this->setPanelIcon("fa fa-bank");
        $this->setPanelName("بانک ها");
        $this->setPanelLink("admin.banks.bank.index");
        $this->insertInTablePanel();
    }

}
