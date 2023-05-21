<?php
namespace App\Http\Services\onTimeService\Admins;

use App\Repositories\ContextRepository;

class CreatePanelGroupAdminService extends BaseAdminPanelGroupService{

    protected function insertInTablePanelGroup(){

        $panelGroup = ContextRepository::PanelGroupRepository()->getPanelGroupWithTitle($this->getPanelGroupTitleEn());

        if (empty($panelGroup)){

            $data = [
                "title" => $this->getPanelGroupTitle() ,
                "title_en" => $this->getPanelGroupTitleEn()
            ];

            ContextRepository::PanelGroupRepository()->addResult($data);
        }
    }

}
