<?php

namespace App\Models\Orders;

use App\Models\Banks\BankPayment;
use App\Models\Banks\BankPaymentRefund;
use App\Models\Banks\BankPaymentUnVerify;
use App\Models\Users\User;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Config;

/**
 * @property int $id
 * @property string $res_num
 * @property string $code_off
 * @property int $code_price
 * @property int $real_price
 * @property int $off_price
 * @property int $total_Price
 * @property bool $is_finish
 * @property string $description_finish
 * @property int $user_id
 * @property $created_at
 * @property $updated_at
 * --------
 * @property $real_price_text
 * @property $real_price_text_pass
 *
 * @property $off_price_text
 * @property $off_price_text_pass
 *
 * @property $total_price_text
 * @property $total_price_text_pass
 *
 * @property $payment_price_text
 * @property $payment_price_text_pass
 *
 * @property $created_at_persian
 * --------
 * @property User $user
 * @property BankPayment $bankPayments
 * @property OrderBasket $orderBaskets
 * @property BankPaymentRefund $bankPaymentRefunds
 * @property BankPaymentUnVerify $bankPaymentUnVerifies
 */
class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'res_num',
        "code_off" , "code_price" ,
        "real_price" , "off_price" , "total_Price" ,
        "is_finish" , "description_finish" ,
        "user_id",
    ];

    protected $casts = [
        "is_finish" => "boolean"
    ];

    protected $appends = [
        "real_price_text" , "real_price_text_pass" ,
        "off_price_text" , "off_price_text_pass" ,
        "total_price_text" , "total_price_text_pass" ,
        "payment_price_text" , "payment_price_text_pass" ,
        "created_at_persian"
    ];
    ///==============================================
    /// relations
    /// ==============================================


    public static function realPriceText() :Attribute{

        return Attribute::make(
            get: fn($attr , $value) => ($value["real_price"] > 0) ? persianPriceFormat($value["real_price"]) : "0"
        );
    }

    public static function realPriceTextPass() :Attribute{

        return Attribute::make(
            get: fn($attr , $value) => ($value["real_price"] > 0) ? persianPriceFormat($value["real_price"])." ".Config::get("app.passPrice") : "0"
        );
    }

    public static function offPriceText() :Attribute{

        return Attribute::make(
            get: fn($attr , $value) => ($value["off_price"] > 0) ? persianPriceFormat($value["off_price"]) : "0"
        );
    }

    public static function offPriceTextPass() :Attribute{

        return Attribute::make(
            get: fn($attr , $value) => ($value["off_price"] > 0) ? persianPriceFormat($value["off_price"])." ".Config::get("app.passPrice") : "0"
        );
    }

    public static function totalPriceText() :Attribute{

        return Attribute::make(
            get: fn($attr , $value) => ($value["total_Price"] > 0) ? persianPriceFormat($value["total_Price"]) : "0"
        );
    }

    public static function totalPriceTextPass() :Attribute{

        return Attribute::make(
            get: fn($attr , $value) => ($value["total_Price"] > 0) ? persianPriceFormat($value["total_Price"])." ".Config::get("app.passPrice") : "0"
        );
    }



    public static function paymentPriceText() :Attribute{
        return Attribute::make(
            get: fn($attr , $value) => (isset( $value["total_price"]) && isset( $value["code_price"])) ? persianPriceFormat($value["total_price"] - $value["code_price"]) : "-"
        );
    }

    public static function paymentPriceTextPass() :Attribute{
        return Attribute::make(
            get: fn($attr , $value) => (isset( $value["total_price"]) && isset( $value["code_price"])) ? persianPriceFormat($value["total_price"] - $value["code_price"])." ".Config::get("app.passPrice") : "-"
        );
    }


    public static function createdAtPersian() :Attribute{

        return Attribute::make(
            get: fn($attr , $value) => (isset($value["created_at"])) ? jalaliDate($value["created_at"]) : "0"
        );
    }

    ///==============================================
    /// relations
    /// ==============================================

    /// belongsTo
    public function user(){
        return $this->belongsTo(User::class);
    }

    //// hasMany
    public function bankPayments(){
        return $this->hasMany(BankPayment::class);
    }

    public function orderBaskets(){
        return $this->hasMany(OrderBasket::class);
    }

    public function bankPaymentRefunds(){
        return $this->hasMany(BankPaymentRefund::class);
    }

    public function bankPaymentUnVerifies(){
        return $this->hasMany(BankPaymentUnVerify::class);
    }

}
