<?php

namespace App\Models\Banks;

use App\Models\Orders\Order;
use App\Models\Subscribes\SubscribePayment;
use App\Models\Users\User;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Config;

/**
 * @property int $id
 * @property int $code
 * @property string $message
 * @property string $Res_num
 * @property string $authority_num
 * @property string $ref_num
 * @property string $mobile
 * @property string $email
 * @property array $extra_data
 * @property int $amount
 * @property string $description
 * @property string $service_name
 * @property int $user_id
 * @property int $order_id
 * @property bool $active
 * @property bool $is_test
 * @property bool $is_status
 * @property string $text_admin
 * @property $created_at
 * @property $updated_at
 * --------
 * @property string $bank_name
 * @property string $amount_text
 * --------
 * @property User $user
 * @property Order $order
 * @property BankPaymentRefund $bankPaymentRefunds
 * @property BankPaymentUnVerify $bankPaymentUnVerifies
 */
class BankPayment extends Model
{

    use HasFactory;

    protected $fillable = [
        'code', "message" , "service_name" ,
        "Res_num" , "authority_num" , "ref_num" ,
        "mobile" , "email" , "extra_data",
        "amount", "description",
        "user_id" , "order_id" ,
        "active" , "is_test" , "is_status" ,
        "text_admin"
    ];


    protected $casts = [
        "extra_data" => "array" ,
        "is_test" => "boolean" ,
        "is_status" => "boolean" ,
    ];

    protected $appends=[];
    ///==============================================
    /// functions
    /// ==============================================


    public static function amountText() :Attribute{
        return Attribute::make(
            get: fn($attr , $value) => (isset($value["amount"]) ) ? persianPriceFormat($value["amount"])." ریال"  : "0"
        );
    }


    private static function getBankName($paymentClassName)
    {
        $banks=Config::get("payments.payments");
        foreach ($banks as $itemBank){
            if ($paymentClassName == $itemBank["name"]){
                return $itemBank["name_fa"];
            }
        }
        return "";
    }


    ///==============================================
    /// relations
    /// ==============================================

    /// belongsTo

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function order(){
        return $this->belongsTo(Order::class);
    }

    //// hasMany
    public function bankPaymentRefunds(){
        return $this->hasMany(BankPaymentRefund::class);
    }

    public function bankPaymentUnVerifies(){
        return $this->hasMany(BankPaymentUnVerify::class);
    }

}
