<?php
namespace App\Http\Services\onTimeService\Admins\PanelGroups\OffGroup;

use App\Http\Services\onTimeService\Admins\CreatePanelAdminService;

class CreatePanelOffPersonInPanelGroupOff extends CreatePanelAdminService
{
    public static $panelName = "code-off-person";

    public function __construct()
    {
        $this->setPanelGroupName();
        $this->setPanelIcon("fa fa-tag");
        $this->setPanelName("کد تخفیف شخصی");
        $this->setPanelLink("admin.offs.code-off-person.index");
        $this->insertInTablePanel();
    }

}
