<?php
namespace App\Repositories\ModelRepositories;

use App\Models\SiteMap\SitemapFile;
use App\Repositories\InterFaceRepositories\IBaseRepository;
use App\Tools\Models\ModelBaseList;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\DB;
use mysqli_sql_exception;


/**
 * @template TModel
 * @template-implements  IBaseRepository<TModel>
 */
class BaseRepository implements IBaseRepository {

    /**@var Collection|TModel|Builder  $baseModel  */
    private $baseModel;

    /**@var Collection|TModel|Builder $model  */
    protected $model;


    /**
     * @param Model $model
     */
    public function __construct(Model $model)
    {
        $this->baseModel = $model;
        $this->resetClassModel();
    }

    /**
     * @return void
     */
    protected function resetClassModel()
    {
        $this->model = $this->baseModel;
    }



    /**
     * @return Collection<TModel>
     */
    function getAllResult($ifStatus=false)
    {
        $this->resetClassModel();
        $res = $this->model;
        if ($ifStatus){
            $res =$res->where("status" , 1);
        }
        return $res->get();
    }

    /**
     * @return  LengthAwarePaginator
     */
    function getPaginateResult($ifStatus=false ,$numInPage = 15 )
    {
        $this->resetClassModel();
        $res = $this->model;
        if ($ifStatus){
            $res =$res->where("status" , 1);
        }
        return $res->paginate($numInPage);
    }


    /**
     * @return  TModel|null
     */
    function getResult($resultId , $ifStatus=false)
    {
        $this->resetClassModel();
        $res = $this->model;
        if ($ifStatus){
            $res =$res->where("status" , 1);
        }
        return $res->find($resultId);
    }

    /**
     * @return  TModel|null
     */
    function addResult($result)
    {
        $this->resetClassModel();
        try{
            return $this->model->create($result);
        }
        catch (mysqli_sql_exception $e){
            return null;
        }
    }

    /**
     * @return  array|null
     */
    function changeStatusResult(Model $result, $field = "status" , $defaultValue=null)
    {
        $this->resetClassModel();
        $resultExp=[
            "status" => true ,
            "exp" => null
        ];

        $gotoRequest = false;
        if ($defaultValue == null){
            $gotoRequest = true;
        }
        else{
            if (in_array($defaultValue, [0 , 1])){
                $gotoRequest = true;
            }
        }

        if ($gotoRequest){

            if ($defaultValue == null){
                $result[$field] = $result[$field] == 0 ? 1 : 0;
            }
            else{
                $result[$field] = $defaultValue;
            }
            $this->save($result);

            $resultExp["status"] = true;
            $resultExp["exp"] = $this->resultJsonChangeStatus($result , $result[$field] , false , $field , $result[$field]);

        }
        return $resultExp;
    }


    /**
     * @return  bool
     */
    function updateResult(Model $result , $data) : bool
    {
        $this->resetClassModel();
        try{
            $result->update($data);
            return true;
        }
        catch (mysqli_sql_exception $e){
            return false;
        }
    }

    /**
     * @return  bool
     */
    function deleteResult(Model $result) : bool
    {
        $this->resetClassModel();
        try{
            if (get_class($result) == get_class($this->model)){
                $result->delete();
                return true;
            }
            return false;
        }
        catch (mysqli_sql_exception $e){
            return false;
        }
    }

    /**
     * @return  bool
     */
    function deleteResultById($resultId): bool
    {
        $this->resetClassModel();
        return $this->deleteResult($this->getResult($resultId));
    }


    /**
     * @return  void
     */
    function save($model) : void
    {
        $model->save();
    }


    /**
     * @return TModel
     */
    function addSearcher(string $property  , string $value)
    {
        return $this->model->where(function($where) use ($property , $value){

            $where->orWhere(DB::raw($property)  , "like" , $value."%")
                ->orWhere(DB::raw($property)  , "like" , "%".$value)
                ->orWhere(DB::raw($property) , "like" , "%".$value."%")
                ->orWhere(DB::raw($property)  , "like" , $value);

        });

    }





    ////// ==========================================================
    protected function resultJsonChangeStatus($resultAction , $fieldResult , $reverse = false , $field="status" , $finalValue=0){
        if ($resultAction){
            if ($fieldResult == 1){
                if ($reverse){
                    return response()->json(["status" => true , "checked" => false , "field" => $field  , "value" => $finalValue]);
                }
                else{
                    return response()->json(["status" => true , "checked" => true , "field" => $field , "value" => $finalValue]);
                }

            }
            else{
                if ($reverse){
                    return response()->json(["status" => true , "checked" => true , "field" => $field , "value" => $finalValue]);
                }
                else{
                    return response()->json(["status" => true , "checked" => false , "field" => $field , "value" => $finalValue]);
                }

            }
        }
        else{
            return response()->json(["status" => false]);
        }
    }



}

