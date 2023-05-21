<?php

namespace App\Http\Services\ContextService\BaseService;


use App\Http\Services\ContextService\Payment\BaseService\Models\ServiceInfoModel;
use App\Http\Services\ContextService\Payment\BaseService\PaymentMessageBaseService;
use Exception;
use Illuminate\Support\Facades\Config;

/**
 * @template T
 * @template-extends BaseService<T>
 */
class BaseService extends PaymentMessageBaseService implements IBaseService {

    private static $serviceConfig;

    public function __construct($serviceConfig)
    {
        parent::__construct();
        self::$serviceConfig = $serviceConfig;
    }




    ///// ==============================

    /**
     * @inheritDoc
     */
    public function getListServiceClass(){
        if (Config::has(self::$serviceConfig)){
            return Config::get(self::$serviceConfig);
        }
        return null;
    }

    /**
     * @inheritDoc
     */
    public function getTitleFaService($titleEn){
        $listClass = self::getListServiceClass();
        if ($listClass != null && !empty($listClass)){
            /**@var ServiceInfoModel $itemClass*/
            foreach ($listClass as $itemClass){
                if ($itemClass->getName() == $titleEn){
                    return $itemClass->getNameFa();
                }
            }
        }
        return null;
    }

    private function getNameSpaceClassService($titleEn){
        $listClass = self::getListServiceClass();
        if ($listClass != null && !empty($listClass)){
            /**@var ServiceInfoModel $itemClass*/
            foreach ($listClass as $itemClass){
                if ($itemClass->getName() == $titleEn){
                    return $itemClass->getClass();
                }
            }
        }
        return null;
    }


    /**@return T|Null */
    protected function getInstanceClassService(string $className)
    {
        $nameSpaceClass = $this->getNameSpaceClassService($className);

        if ($nameSpaceClass != null && !empty($nameSpaceClass)){
            try{
                /**@var T $instance*/
                return (new \ReflectionClass($nameSpaceClass))->newInstance();
            }
            catch (Exception $e){
                return null;
            }
        }

        return null;
    }

}
