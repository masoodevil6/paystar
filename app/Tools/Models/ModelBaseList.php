<?php
namespace App\Tools\Models;
use Illuminate\Support\Collection;


/**
 * @template T
 * @template-implements IModelBaseList<T>
 */
class ModelBaseList implements IModelBaseList{


    /**
     * @var string $className
     */
    private string $className ="";


    /**
     * @var T[] $list
     */
    private  $list =[];


    /**
     * @param class-string<T> $className
     * @return void
     */
    public function __construct($className)
    {
        $this->className = $className;

    }


    /**
     * @param  T $item
     * @return void
     */
    public function add($item)
    {
        if ($item instanceof $this->className){
            array_push($this->list , $item);
        }
    }

    /**
     * @param int $index
     * @return T|null
     */
    public function get($index)
    {
        if (isset($this->list[$index])){
            return $this->list[$index];
        }
        return null;
    }


    /**
     * @return Collection
     */
    public function getCollect():Collection
    {
        return  collect($this->toArray());
    }


    /**
     * @return T[]
     */
    public function toArray()
    {
        return  $this->list;
    }


    /**
     * @return int
     */
    public function getSize()
    {
        return  sizeof($this->list);
    }

}
