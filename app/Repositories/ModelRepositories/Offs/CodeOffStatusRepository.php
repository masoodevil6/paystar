<?php
namespace App\Repositories\ModelRepositories\Offs;

use App\Models\Offs\CodeOffStatus;
use App\Repositories\InterFaceRepositories\Offs\ICodeOffStatusRepository;
use App\Repositories\ModelRepositories\BaseRepository;

/**
 * @template-extends BaseRepository<CodeOffStatus>
 * @template-implements  ICodeOffStatusRepository<CodeOffStatus>
 */
class CodeOffStatusRepository extends BaseRepository implements ICodeOffStatusRepository {

    private $orderByList = [
        [
            "id" => 0 ,
            "title_en" => "min_price" ,
            "title_fa" => "حداقل مبلغ سفارش" ,
        ] ,
        [
            "id" => 1 ,
            "title_en" => "off_price" ,
            "title_fa" => " مبلغ تخفیف" ,
        ] ,
        [
            "id" => 2 ,
            "title_en" => "period" ,
            "title_fa" => "مدت تخفیف" ,
        ] ,
    ];


    public function __construct()
    {
        parent::__construct(new CodeOffStatus());
    }

    /**
     * @inheritDoc
     */
    function GetListOrderBy()
    {
        return $this->orderByList;
    }

    /**
     * @inheritDoc
     */
    function SearchCodeOffStatusByStatusAndOrderBy($status = null, $orderBy = null , $numInPage = 15)
    {
        if ($status != null && in_array($status , [0 , 1])){
            $this->model = $this->model->where("status" , $status);
        }

        if ($orderBy != null){
            $OrderByInfo = null;
            foreach ($this->GetListOrderBy() as $item){
                if ($item["id"] == $orderBy){
                    $OrderByInfo = $item;
                    break;
                }
            }

            if ($OrderByInfo != null){
                $this->model = $this->model->orderBy($OrderByInfo["title_en"] , "desc");
            }
        }

        return $this->model->paginate($numInPage);
    }
}
