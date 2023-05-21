<?php

namespace App\Http\Services\onTimeService\Admins\PanelGroups\BankGroup;

use App\Http\Services\onTimeService\Admins\CreatePanelAdminService;

class CreatePanelBankPaymentRefundInPanelGroupBank extends CreatePanelAdminService
{
    public static $panelName = "bank-payment-refunds";

    public function __construct()
    {
        $this->setPanelGroupName();
        $this->setPanelIcon("fa fa-undo");
        $this->setPanelName("درخواست های استرداد");
        $this->setPanelLink("admin.banks.refund.index");
        $this->insertInTablePanel();
    }

}
