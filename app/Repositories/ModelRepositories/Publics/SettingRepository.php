<?php
namespace App\Repositories\ModelRepositories\Publics;

use App\Models\Publics\Setting;
use App\Repositories\InterFaceRepositories\Publics\ISettingRepository;
use App\Repositories\ModelRepositories\BaseRepository;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\View;

/**
 * @template-extends BaseRepository<Setting>
 * @template-implements  ISettingRepository<Setting>
 */
class SettingRepository extends BaseRepository implements ISettingRepository {

    public function __construct()
    {
        parent::__construct(new Setting());
    }

    /**
     * @inheritDoc
     */
    function createItemSettingIfNotExist(string  $titleEn , string $titleFa , string $value): void
    {
        if (empty($this->model->where("titleEn" , $titleEn)->first())){

            $data = [
                "titleEn" => $titleEn,
                "titleFa" => $titleFa,
                "value" => $value,
            ];

            $this->addResult($data);
        }
    }


    /**
     * @inheritDoc
     */
    function SetSettingInfoPage($convertAboutUsToHtml=false)
    {
        $settings = $this->getAllResult();
        $siteName = $this->getSiteName($settings);
        $socials = $this->getLocationSocialSite($settings);
        $aboutUs = $this->getAboutUsSite($settings);
        $infoSite = $this->getInfoSite($settings);

        if ($convertAboutUsToHtml){
            $aboutUs = $this->ConvertAboutUsToHtml($aboutUs);
        }


        View::composer("vue.layouts.header" , function ($view) use($socials){
            $view->with("socials" , $socials);
        });

        View::composer("vue.layouts.footer" , function ($view) use($socials , $aboutUs , $siteName){
            $view->with("socials" , $socials);
            $view->with("aboutUs" , $aboutUs);
            $view->with("version" , Config::get("app.version"));
            $view->with("siteName" , $siteName["site_name_fa"]);
        });

        View::composer("vue.layouts.header" , function ($view) use($socials , $aboutUs , $siteName){
            $view->with("siteName" , $siteName["site_name_fa"]);
        });

        View::composer("vue.layouts.seo-tag" , function ($view) use($siteName){
            $view->with("siteName" , $siteName);
        });

        return [
            "siteName" => $siteName ,
            "aboutUs" => $aboutUs ,
            "infoSite" => $infoSite ,
            "socials" => $socials
        ];
    }

    /**
     * @inheritDoc
     */
    function getSiteNameFa()
    {
        $siteName = "";
        $info  = $this->model->select("value")->where("titleEn" , "site_name")->first();
        if (!empty($info) && $info != null){
            $siteName = $info->value;
        }

        return $siteName;
    }



    //// ====================================
    /**
     * @return  array
     */
    protected function getSiteName($setting){

        $siteName = "";
        $siteNameEn = "";

        foreach ($setting As $itemSetting){
            if ($itemSetting["titleEn"] == "site_name"){
                $siteName = $itemSetting["value"];
            }
            else if ($itemSetting["titleEn"] == "site_name_en"){
                $siteNameEn = $itemSetting["value"];
            }
        }

        return [
            "site_name_fa" => $siteName ,
            "site_name_en" => $siteNameEn ,
        ];
    }

    /**
     * @return  array
     */
    protected function getLocationSocialSite($setting){

        $resultExp = [];

        foreach ($setting As $itemSetting){

            if ($itemSetting["titleEn"] == "telegram" && $itemSetting["value"] != ""){
                $res["url"] = $itemSetting["value"];
                $res["title"] = "آدرس تلگرام";
                $res["icon"] = "fa fa-telegram";
                $res["Social"] = "Telegram";
                array_push($resultExp , $res);
            }
            else if ($itemSetting["titleEn"] == "instagram" && $itemSetting["value"] != ""){
                $res["url"] = $itemSetting["value"];
                $res["title"] = "آدرس ایستاگرام";
                $res["icon"] = "fa fa-instagram";
                $res["Social"] = "Instagram";
                array_push($resultExp , $res);
            }
            else if ($itemSetting["titleEn"] == "facebook" && $itemSetting["value"] != ""){
                $res["url"] = $itemSetting["value"];
                $res["title"] = "آدرس فیسبوک";
                $res["icon"] = "fa fa-facebook-square";
                $res["Social"] = "Facebook";
                array_push($resultExp , $res);
            }
            else if ($itemSetting["titleEn"] == "twitter" && $itemSetting["value"] != ""){
                $res["url"] = $itemSetting["value"];
                $res["title"] = "آدرس تویتر";
                $res["icon"] = "fa  fa-twitter-square";
                $res["Social"] = "Twitter";
                array_push($resultExp , $res);
            }

        }

        return $resultExp;
    }

    /**
     * @return  string
     */
    protected function getAboutUsSite($setting){

        $aboutUs = "";

        foreach ($setting As $itemSetting){
            if ($itemSetting["titleEn"] == "about_us"){
                $aboutUs = $itemSetting["value"];
            }
        }

        return $aboutUs;
    }

    /**
     * @return  array
     */
    protected function getInfoSite($setting){
        $info = null;

        foreach ($setting As $itemSetting){
            if (($itemSetting["titleEn"] == "address" || $itemSetting["titleEn"] == "site_email" || $itemSetting["titleEn"] == "site_phone") && $itemSetting["value"] != null){
                $info[$itemSetting["titleEn"]] = $itemSetting["value"];
            }
        }

        return $info;
    }

    /**
     * @return  string
     */
    protected function ConvertAboutUsToHtml($aboutUs){
        return ConvertToHtmlForWPF($aboutUs);
    }


}
