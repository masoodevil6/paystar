<?php
namespace App\Repositories\ModelRepositories\Offs;

use App\Http\Services\onTimeService\Images\ImageService;
use App\Http\Services\onTimeService\Time\TimeService;
use App\Models\Offs\CodeOff;
use App\Repositories\InterFaceRepositories\Offs\ICodeOffRepository;
use App\Repositories\ModelRepositories\BaseRepository;
use function League\Flysystem\delete;

/**
 * @template-extends BaseRepository<CodeOff>
 * @template-implements  ICodeOffRepository<CodeOff>
 */
class CodeOffRepository extends BaseRepository implements ICodeOffRepository {

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
        parent::__construct(new CodeOff());
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
    public function SearchListCodeOff($status = null, $orderBy = null , $isActive=null, $public=0 , $numInPage = 15 )
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

        if ($isActive != null && in_array($status , [0 , 1])){
            if($isActive == 1){
                $this->model = $this->model->whereRaw( "DATE_ADD(coalesce(created_at, now()) , INTERVAL period DAY) >= NOW()");
            }
            else if($isActive == 0){
                $this->model = $this->model->whereRaw( "DATE_ADD(coalesce(created_at, now()) , INTERVAL period DAY) < NOW()");
            }
        }

        if ($public == 1){
            $this->model = $this->model->whereNull("user_id");
        }

        return $this->model->where("is_public" , $public)->paginate($numInPage);
    }

    /**
     * @inheritDoc
     */
    function GetCodeOff(int $id , int $public=0)
    {
        if ($public == 1){
            $this->model = $this->model->whereNull("user_id");
        }

        return $this->model
            ->where("is_public" , $public)
            ->where("id" , $id)
            ->first();
    }

    /**
     * @inheritDoc
     */
    function CheckCodeOff($codeOff , $orderAmount)
    {
        $resultExp = [
            "title" => "کد تخفیف یافت نشد" ,
            "status" => false ,
            "off" => 0 ,
            "isPublic" => false ,
            "time_expire" => null
        ];

        $recordCodeOff = $this->model
            ->where("code" , $codeOff)
            ->where("status" , 1)
            ->first();

        if (!empty($recordCodeOff) && $recordCodeOff!= null){

            if ($recordCodeOff->is_public == 1){
                $resultExp["isPublic"] = true;
            }

            $resultExp["title"] = "کد تخفیف، منقضی شده است";

            $dateOne = TimeService::getDateFromNowInstance(
                TimeService::$day ,
                TimeService::$typeSub ,
                $recordCodeOff->period
            );
            $dateTwo = $recordCodeOff->created_at;

            if ($dateOne->lte($dateTwo)){

                $resultExp["title"] = "سفارش شما، باید بیش از ".persianPriceFormat($recordCodeOff->min_price)." تومان باشد تا بتوانید از کد تخفیف استفاده نمایید";

                if ($recordCodeOff->min_price <= $orderAmount){

                    if ($recordCodeOff->is_public == 0 && $recordCodeOff->used == 1){
                        $resultExp["title"] = "کد تخفیف قبلا استفاده شده است";
                    }
                    else{
                        $resultExp["title"] = "کد تخفیف، تایید شد [ تخفیف ".persianPriceFormat($recordCodeOff->off_price)." تومانی ]";
                        $resultExp["status"] = true;
                        $resultExp["off"] = $recordCodeOff->off_price;
                        $resultExp["time_expire"] = TimeService::calculateDateFromTimeString(
                            $recordCodeOff->created_at ,
                            TimeService::$day ,
                            TimeService::$typeAdd ,
                            $recordCodeOff->period);
                    }

                }

            }
        }

        return $resultExp;
    }

    /**
     * @inheritDoc
     */
    function setUsedCodeOff($codeOff)
    {
        $this->model
            ->where("code" , $codeOff)
            ->where("is_public" , 0)
            ->update([
                "used" => 1
            ]);
    }


    /**
     * @inheritDoc
     */
    function GetImageLastActiveCodeOffPublic()
    {
        $codeOffPublic = $this->model
            ->select("image" , "code")
            ->where("is_public" , 1)
            ->where("status" , 1)
            ->whereNull("user_id")
            ->whereRaw( "DATE_ADD(coalesce(created_at, now()) , INTERVAL period DAY) > NOW()")
            ->orderBy("id" , "desc")
            ->first();

        if (!empty($codeOffPublic) && $codeOffPublic!=null){
            return [
                "image" => $codeOffPublic->image ,
                "code" => $codeOffPublic->code
            ];
        }
        return null;
    }

    //-------------------------------------------------------

    /**
     * @inheritDoc
     */
    function DeleteCodeOffExpired()
    {
        $codeOffs = $this->model->whereRaw( "DATE_ADD(coalesce(created_at, now()) , INTERVAL period DAY) < NOW()") ->get();
        $imageService = new ImageService();

        /**@var CodeOff $codeOff*/
        foreach ($codeOffs as $codeOff){
            if (!empty($codeOff->image) && $codeOff->image!=null){
                $imageService->deleteImage($codeOff->image);
            }
            $codeOff->delete();
        }
    }


}
