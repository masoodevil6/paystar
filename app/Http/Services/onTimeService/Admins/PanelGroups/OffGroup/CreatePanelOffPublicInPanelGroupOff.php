<?php
namespace App\Http\Services\onTimeService\Admins\PanelGroups\OffGroup;

use App\Http\Services\onTimeService\Admins\CreatePanelAdminService;

class CreatePanelOffPublicInPanelGroupOff extends CreatePanelAdminService
{
    public static $panelName = "code-off-public";

    public function __construct()
    {
        $this->setPanelGroupName();
        $this->setPanelIcon("fa fa-gift");
        $this->setPanelName("کد تخفیف عمومی");
        $this->setPanelLink("admin.offs.code-off-public.index");
        $this->insertInTablePanel();
    }

}
