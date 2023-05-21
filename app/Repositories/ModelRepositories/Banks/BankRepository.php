<?php
namespace App\Repositories\ModelRepositories\Banks;

use App\Http\Services\Banks\BanksService\Models\ModelResultPayment;
use App\Http\Services\ContextService\Payment\BaseService\Models\ServiceInfoModel;
use App\Models\Banks\Bank;
use App\Models\Banks\BankPayment;
use App\Repositories\InterFaceRepositories\Banks\IBanckRepository;
use App\Repositories\ModelRepositories\BaseRepository;
use Illuminate\Support\Facades\Config;

/**
 * @template-extends BaseRepository<Bank>
 * @template-implements  IBanckRepository<Bank>
 */
class BankRepository extends BaseRepository implements IBanckRepository {

    public function __construct()
    {
        parent::__construct(new Bank());
    }


    /**
     * @inheritDoc
     */
    function SearchBank(string $bankName = "", $numInPage = 15)
    {
        if ($bankName != ""){
            $this->model = $this->addSearcher("title" , $bankName);
        }

        return $this->model->paginate($numInPage);
    }


    /**
     * @inheritDoc
     */
    function GetMerchantIdFromServiceName(string $serviceName)
    {
        return $this->model
            ->select("merchant_id" , "access_token")
            ->where("service_name" , $serviceName)
            ->where("status" , 1)
            ->first();
    }


    /**
     * @inheritDoc
     */
    function GetMerchantIdAndAccessTokenFromServiceName(string $serviceName)
    {
        return $this->model
            ->select("merchant_id" , "access_token")
            ->where("service_name" , $serviceName)
            ->where("status" , 1)
            ->first();
    }


    /**
     * @inheritDoc
     */
    function GetListPaymentThatActive()
    {

        $listBanks = $this->model
            ->select(["service_name" , "image_location" , "image_type" , "image_title" , "image_alt"])
            ->where("status" , 1)
            ->get();


        foreach ($listBanks as $key => $bank){
            if ($this->existConfigPaymentClass($bank->service_name)){
                $listBanks[$key]["title"] = $this->getTitlePaymentClass($bank->class_name);
            }
            else{
                $listBanks->forget($key);
            }
        }


        return $listBanks;
    }


    /**
     * @inheritDoc
     */
    function CheckExistBank($className)
    {
        return $this->existConfigPaymentClass($className);
    }


    //// =======================================
    /**
     * @return  array
     */
    private function getListPaymentsClass(){
        return Config::get("payments.payments");
    }


    /**
     * @return  bool
     */
    private function existConfigPaymentClass($className){
        $Banks = $this->getListPaymentsClass();

        /**@var ServiceInfoModel $bank*/
        foreach ($Banks as $bank){
            if ($bank->getName() == $className){
                return true;
            }
        }

        return false;
    }


    /**
     * @return  string
     */
    private function getTitlePaymentClass($className){
        $Banks = $this->getListPaymentsClass();

        /**@var ServiceInfoModel $bank*/
        foreach ($Banks as $bank){
            if ($bank->getName() == $className){
                return $bank->getNameFa();
            }
        }

        return null;
    }


}
