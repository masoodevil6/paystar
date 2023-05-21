<?php
namespace App\Repositories\InterFaceRepositories\Panels;

use App\Repositories\InterFaceRepositories\IBaseRepository;

/**
 * @template T
 * @template-extends IBaseRepository<T>
 */
interface IPanelGroupRepository extends IBaseRepository {

    /**
     * @return  T
     */
    function getPanelGroupWithTitle(string $title);

    /**
     * @return  void
     */
    function deleteAllRecord() : void;
}
