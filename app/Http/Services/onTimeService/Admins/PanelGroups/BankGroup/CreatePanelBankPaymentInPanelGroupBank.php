<?php

namespace App\Http\Services\onTimeService\Admins\PanelGroups\BankGroup;

use App\Http\Services\onTimeService\Admins\CreatePanelAdminService;

class CreatePanelBankPaymentInPanelGroupBank extends CreatePanelAdminService
{
    public static $panelName = "bank-payments";

    public function __construct()
    {
        $this->setPanelGroupName();
        $this->setPanelIcon("fa fa-usd");
        $this->setPanelName("تراکنش ها");
        $this->setPanelLink("admin.banks.payment.index");
        $this->insertInTablePanel();
    }

}
