<?php
namespace App\Repositories\ModelRepositories\Subscribes;

use App\Models\Subscribes\Subscribe;
use App\Models\Subscribes\SubscribePayment;
use App\Repositories\ContextRepository;
use App\Repositories\InterFaceRepositories\Subscribes\ISubscribeRepository;
use App\Repositories\ModelRepositories\BaseRepository;
use Illuminate\Support\Facades\DB;

/**
 * @template-extends BaseRepository<Subscribe>
 * @template-implements  ISubscribeRepository<Subscribe>
 */
class SubscribeRepository extends BaseRepository implements ISubscribeRepository {

    public function __construct()
    {
        parent::__construct(new Subscribe());
    }

    /**
     * @inheritDoc
     */
    function SearchSubscribe(string $subscribeName = "", $numInPage = 15)
    {
        if ($subscribeName != ""){
            $this->model = $this->addSearcher('title' , $subscribeName);
        }

        return $this->model->paginate($numInPage);
    }

    /**
     * @inheritDoc
     */
    function GetLimitRandomSelectedSubscribe(int $limitSubscribe=10 , int $limitForm=6)
    {
        $listSubscribesActives = $this->getListSubscribeActive();
        $subscribesActives = [];
        foreach ($listSubscribesActives as $itemSubscribe){
            array_push($subscribesActives , $itemSubscribe->subscribe_id);
        }

        $result = $this->model
            ->with("forms")
            ->where("subscribes.status" , 1)
            ->where("subscribes.selected" , 1)
            ->limit($limitSubscribe)
            ->whereNotIn('id', $subscribesActives)
            ->inRandomOrder()
            ->get();

        foreach ($result as $key => $itemSubscribe){
            $result[$key]->forms = $this->getLimitFromsInSubscribeThatActive($itemSubscribe->forms  , $limitForm);
        }

        return $result;
    }

    /**
     * @inheritDoc
     */
    function GetListSubscribes($numInPage = 15, int $limitForm = 6)
    {
        $result = $this->model
            ->select([
                "subscribes.id" ,"subscribes.title" ,"subscribes.real_price" ,"subscribes.off_price" ,"subscribes.duration" ,"subscribes.description" ,"subscribes.slug" ,
            ])
            ->where("subscribes.status" , 1);
        if ($limitForm > 0){
            $result =$result->with("forms");
        }
        $result = $result->paginate($numInPage);

        if ($limitForm > 0){
            foreach ($result as $key => $itemSubscribe){
                $result[$key]->forms = $this->getLimitFromsInSubscribeThatActive($itemSubscribe->forms  , $numInPage);
            }
        }
        $result = $this->setStateActiveListSubscribe($result);

        return $result;
    }

    /**
     * @inheritDoc
     */
    function GetInfoSubscribe($slug)
    {
        $result =
            $this->model
                ->where("slug" , $slug)
                ->where("status" , 1)
                ->first();

        if (!empty($result)){
            $result->active = $this->setStateActiveSubscribe($this->getListSubscribeActive() , $result->id);
            return $result;
        }

        return $result;
    }



    /**
     * @inheritDoc
     */
    function GetInfoSubscribeWithSelectedForm($slug, $numForm=10)
    {
        $result = [
            "subscribe" => null ,
            "forms" => null ,
        ];

        $result["subscribe"] =
            $this->model
                ->where("slug" , $slug)
                ->where("status" , 1)
                ->first();

        if ($result["subscribe"] != null && !empty($result["subscribe"])){
            $result["subscribe"]->active = $this->setStateActiveSubscribe($this->getListSubscribeActive() , $result["subscribe"]->id);
            if ($numForm > 0){
                $result["forms"] = $result["subscribe"]->forms()->where("selected" , 1)->take($numForm)->get();
            }
        }

        return $result;
    }




    /**
     * @inheritDoc
     */
    function GetSlugSubscribeForm($subscribe_id)
    {
        $subscribe = ContextRepository::SubscribeRepository()->getResult($subscribe_id , true);
        $slug = "";
        if (!empty($subscribe)){
            $slug =  $subscribe->slug;
        }
        return $slug;
    }

    /**
     * @inheritDoc
     */
    function getSqlSubscribeWithSlug($slug)
    {
        return  $this->model
            ->select("id")
            ->where("slug" , $slug)
            ->where("status" , 1)
            ->toSql();
    }

    /**
     * @inheritDoc
     */
    function getListSeoPagesSubscirbe($numInPage = 15)
    {
        return $this->model
            ->with("meta")
            ->paginate($numInPage);
    }






    //// ==================================
    /**
     * @return  string
     */
    private function readyImageForm($formImage){
        $imageForm = "";
        if (!empty($formImage)){
            $imageForm = $formImage["indexArray"][$formImage["currentImage"]];
        }
        return $imageForm;
    }

    /**
     * @return  array
     */
    private function getLimitFromsInSubscribeThatActive($result , $limitForm){
        $resultExp = [];
        foreach ($result As $key=>$itemForm ){
            if (($limitForm > 0 && sizeof($resultExp) < $limitForm) || $limitForm==0){
                $result[$key]-> image = $this->readyImageForm($itemForm["image"]);

                if (file_exists($result[$key]["image"])){
                    array_push($resultExp , $result[$key]);
                }
                else{
                    if ($limitForm==0){
                        $result[$key]-> image = "";
                        array_push($resultExp , $result[$key]);
                    }
                }

            }
        }
        return $resultExp;
    }



    ////// --------------------------
    /**
     * @return  SubscribePayment
     */
    private function getListSubscribeActive(){
        return ContextRepository::SubscribePaymentRepository()->GetSubscribeActiveNow();
    }

    /**
     * @return  array
     */
    private function setStateActiveListSubscribe($subscribes){
        $subscribesActive = $this->getListSubscribeActive();
        foreach ($subscribes as $key => $itemSubscribe){
            $subscribes[$key]["active"] = $this->setStateActiveSubscribe($subscribesActive , $itemSubscribe["id"]);
        }
        return $subscribes;
    }

    /**
     * @return  bool
     */
    private function setStateActiveSubscribe($listSubscribeActive , $subscribe_id){
        $active = false;
        foreach ($listSubscribeActive As $item){
            if ($item->subscribe_id == $subscribe_id){
                $active = true;
                break;
            }
        }
        return $active;
    }



}

