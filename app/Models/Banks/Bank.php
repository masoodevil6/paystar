<?php

namespace App\Models\Banks;

use App\Models\Subscribes\SubscribePayment;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $title
 * @property int $status
 * @property string $merchant_id
 * @property string $access_token
 * @property string $service_name
 * @property string $image_location
 * @property int $image_type
 * @property string $image_alt
 * @property string $image_title
 * @property $created_at
 * @property $updated_at
 * --------
 * @property string $image
 * --------
 * @property SubscribePayment $SubscribePayments
 */
class Bank extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', "status" ,
        "merchant_id" , "access_token" ,
        "service_name" ,
        "image_location" , "image_type" ,
        "image_alt", "image_title"
    ];

    protected $appends = ["image"];

    ///==============================================
    /// functions
    /// ==============================================

    public static function image() :Attribute{

        return Attribute::make(
            get: fn($attr , $value) => ($value["image_type"] == 0) ? $value["image_location"] : asset($value["image_location"])
        );
    }


    ///==============================================
    /// relations
    /// ==============================================

    //// hasMany
    public function SubscribePayments(){
        return $this->hasMany(SubscribePayment::class);
    }
}
