<?php

namespace App\Http\Services\ContextService\BaseService;

interface IBaseService
{
    /**@return array|null */
    function getListServiceClass();

    /**@return string|null */
    function getTitleFaService($titleEn);
}
