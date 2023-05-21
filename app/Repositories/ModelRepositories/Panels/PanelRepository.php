<?php
namespace App\Repositories\ModelRepositories\Panels;

use App\Models\Panel\Panel;
use App\Repositories\InterFaceRepositories\Panels\IPanelRepository;
use App\Repositories\ModelRepositories\BaseRepository;

/**
 * @template-extends BaseRepository<Panel>
 * @template-implements  IPanelRepository<Panel>
 */
class PanelRepository extends BaseRepository implements IPanelRepository {

    public function __construct()
    {
        parent::__construct(new Panel());
    }

    /**
     * @inheritDoc
     */
    function getPanelGroupAndLink(int $panelGroupId, string $link)
    {
        return $this->model->where("panel_group_id" , $panelGroupId)->where("link" , $link)->first();
    }

    /**
     * @inheritDoc
     */
    function deleteAllRecord() : void
    {
        $this->model->query()->delete();
    }
}
