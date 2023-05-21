<?php

namespace App\Models\Banks;

use App\Models\Orders\Order;
use App\Models\Users\User;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Config;

/**
 * @property int $id
 * @property array $extra_data
 * @property int $amount
 * @property $date_submit
 * @property string $service_name
 * @property int $user_id
 * @property int $bank_payment_id
 * @property int $order_id
 * @property bool $status
 * @property $created_at
 * @property $updated_at
 * --------
 * @property string $bank_name
 * --------
 * @property User $user
 * @property Order $order
 * @property BankPayment $bankPayment
 */
class BankPaymentUnVerify extends Model
{
    use HasFactory;

    protected $fillable = [
        "authority_num" , "extra_data",
        "amount", "date_submit", "service_name" ,
        "user_id" , "bank_payment_id" , "order_id" ,
        "status"
    ];


    protected $casts = [
        "extra_data" => "array" ,
        "status" => "boolean" ,
    ];

    protected $appends=[];
    ///==============================================
    /// functions
    /// ==============================================





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

    public function bankPayment(){
        return $this->belongsTo(BankPayment::class);
    }


    //// hasMany
}
