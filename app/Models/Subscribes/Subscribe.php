<?php

namespace App\Models\Subscribes;

use App\Models\Orders\OrderBasket;
use App\Models\PhoneStores\PhoneStorePurchase;
use App\Models\Seo\SeoMeta;
use App\Repositories\ContextRepository;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Config;
use Cviebrock\EloquentSluggable\Sluggable;

/**
 * @property int $id
 * @property $title
 * @property $real_price
 * @property $off_price
 * @property $duration
 * @property $status
 * @property $description
 * @property $selected
 * @property $slug
 * @property $sku
 * @property $created_at
 * @property $updated_at
 * --------
 * @property $description_html
 * @property $duration_text
 * @property $real_price_text
 * @property $off_price_text
 * @property $total_price
 * @property $total_price_text
 * --------
 * @property $OrderBaskets
 * @property $meta
 * @property $metaInfo
 *
 * @property SubscribePayment $payments
 * @property PhoneStorePurchase $phoneStorePurchases
 */
class Subscribe extends Model
{
    use HasFactory;
    use Sluggable;

    protected $fillable = [
        'title' , "real_price" , "off_price" , "duration" , "status" , "description" , "selected" , "sku"
    ];

    protected $appends = ["description_html" , "duration_text" , "real_price_text" , "off_price_text" , "total_price" , "total_price_text"];


    ///==============================================
    /// properties
    /// ==============================================
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }


    ///==============================================
    /// functions
    /// ==============================================

    public static function descriptionHtml() :Attribute{

        return Attribute::make(
            get: fn($attr , $value) =>  ((isset($value["description"])) ? ConvertToHtmlForWPF($value["description"]) : 0)
        );
    }


    public static function durationText() :Attribute{

        return Attribute::make(
            get: fn($attr , $value) =>  ((isset($value["duration"])) ? convertEnglishToPersian($value["duration"]) : 0) ." ". Config::get("app.passDuration")
        );
    }

    public static function realPriceText() :Attribute{

        return Attribute::make(
            get: fn($attr , $value) =>  persianPriceFormat ((isset($value["real_price"])) ? $value["real_price"] : 0)." ". Config::get("app.passPrice")
        );
    }

    public static function offPriceText() :Attribute{

        return Attribute::make(
            get: fn($attr , $value) =>   persianPriceFormat((isset($value["off_price"])) ? $value["off_price"] : 0) ." ". Config::get("app.passPrice")
        );
    }


    public static function totalPrice() :Attribute{

        return Attribute::make(
            get: fn($attr , $value) =>  ((isset($value["real_price"]) && $value["off_price"]) ? ($value["real_price"] - $value["off_price"]) : 0)
        );
    }

    public static function totalPriceText() :Attribute{

        return Attribute::make(
            get: fn($attr , $value) =>  (isset($value["real_price"]) && isset($value["off_price"]) && $value["real_price"]>0 ) ? persianPriceFormat ($value["real_price"] - $value["off_price"])." ". Config::get("app.passPrice") : ((isset($value["real_price"])  && $value["real_price"]==0) ? "رایگان" : "")
        );
    }







    ///==============================================
    /// relations
    /// ==============================================

    public function OrderBaskets(){
        return $this->morphMany(OrderBasket::class , "orderBasketable" , "order_basketable_type" , "order_basketable_id");
    }



    //// belongsTo
    public function meta(){
        return $this
            ->hasOne(SeoMeta::class , "meta_id")
            ->select("seo_metas.*")
            ->join("seo_pages" , function ($join){
                $join->on("seo_metas.seo_page_id" , "seo_pages.id")
                    ->where("seo_pages.title" , ContextRepository::SeoPageRepository()->getTitleSubscribesSeo())
                    ->where("seo_pages.spical" , 0);
            });
    }

    public function metaInfo(){
        return $this->meta()->with(["keywords" , "robots"]);
    }




    //// has many

    public function payments(){
        return $this->hasMany(SubscribePayment::class);
    }

    public function phoneStorePurchases(){
        return $this->hasMany(PhoneStorePurchase::class);
    }
}
