<?php
namespace App\Repositories\ModelRepositories\Panels;

use App\Models\Panel\PanelGroup;
use App\Repositories\InterFaceRepositories\Panels\IPanelGroupRepository;
use App\Repositories\ModelRepositories\BaseRepository;

/**
 * @template-extends BaseRepository<PanelGroup>
 * @template-implements  IPanelGroupRepository<PanelGroup>
 */
class PanelGroupRepository extends BaseRepository implements IPanelGroupRepository {

    public function __construct()
    {
        parent::__construct(new PanelGroup());
    }

    /**
     * @inheritDoc
     */
    function getPanelGroupWithTitle(string $title)
    {
        return $this->model->where("title_en" , $title)->first();
    }

    /**
     * @inheritDoc
     */
    function deleteAllRecord(): void
    {
        $this->model->query()->delete();
    }
}
