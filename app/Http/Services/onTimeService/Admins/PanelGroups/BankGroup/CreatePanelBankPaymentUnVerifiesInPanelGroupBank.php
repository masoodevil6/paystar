<?php

namespace App\Http\Services\onTimeService\Admins\PanelGroups\BankGroup;

use App\Http\Services\onTimeService\Admins\CreatePanelAdminService;

class CreatePanelBankPaymentUnVerifiesInPanelGroupBank extends CreatePanelAdminService
{
    public static $panelName = "bank-payment-un-verifies";

    public function __construct()
    {
        $this->setPanelGroupName();
        $this->setPanelIcon("fa fa-credit-card");
        $this->setPanelName("تراکنش ها un-verifies");
        $this->setPanelLink("admin.banks.un-verifies.index");
        $this->insertInTablePanel();
    }

}
