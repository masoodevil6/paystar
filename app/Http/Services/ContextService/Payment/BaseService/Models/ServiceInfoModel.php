<?php

namespace App\Http\Services\ContextService\Payment\BaseService\Models;


class ServiceInfoModel
{
    private $name_fa;
    private $name;
    private $class;

    /**
     * @return mixed
     */
    public function getNameFa()
    {
        return $this->name_fa;
    }

    /**
     * @param mixed $name_fa
     */
    public function setNameFa($name_fa): void
    {
        $this->name_fa = $name_fa;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name): void
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getClass()
    {
        return $this->class;
    }

    /**
     * @param mixed $class
     */
    public function setClass($class): void
    {
        $this->class = $class;
    }



    public function toArray(){
        return[
            "name_fa" => $this->getNameFa() ,
            "name" => $this->getName() ,
            "class" => $this->getClass()
        ];
    }


}
