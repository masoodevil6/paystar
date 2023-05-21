<?php
namespace App\Repositories\InterFaceRepositories\Panels;

use App\Repositories\InterFaceRepositories\IBaseRepository;

/**
 * @template T
 * @template-extends IBaseRepository<T>
 */
interface IPanelRepository extends IBaseRepository {

    /**
     * @return  T
     */
    function getPanelGroupAndLink(int $panelGroupId ,string $link) ;

    /**
     * @return  void
     */
    function deleteAllRecord() : void;

}
