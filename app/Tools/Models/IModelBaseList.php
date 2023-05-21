<?php
namespace App\Tools\Models;
use Illuminate\Support\Collection;


/**
 * @template T
 */
interface IModelBaseList{

    /**
     * @param  T $item
     * @return void
     */
    public function add($item);

    /**
     * @param int $index
     * @return T|null
     */
    public function get(int $index);

    /**
     * @return Collection
     */
    public function getCollect():Collection;

    /**
     * @return T[]
     */
    public function toArray();


    /**
     * @return int
     */
    public function getSize();

}
