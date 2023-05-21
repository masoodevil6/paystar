<?php
namespace App\Repositories\InterFaceRepositories\Publics;

use App\Repositories\InterFaceRepositories\IBaseRepository;

/**
 * @template T
 * @template-extends IBaseRepository<T>
 */
interface ISettingRepository extends IBaseRepository {

    /**
     * @return  T
     */
    function createItemSettingIfNotExist(string  $titleEn , string $titleFa , string $value) : void;

    /**
     * @return  array
     */
    function getSiteNameFa();

    /**
     * @return  string
     */
    function SetSettingInfoPage($convertAboutUsToHtml=false);
}
