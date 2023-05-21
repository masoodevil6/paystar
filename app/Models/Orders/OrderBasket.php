<?php

namespace App\Models\Orders;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property $order_basketable_type
 * @property $order_basketable_id
 * @property $cookie
 * @property $submitted
 * @property $name
 * @property $description
 * @property $price
 * @property $off
 * @property $order_id
 * @property $created_at
 * @property $updated_at
 * --------
 * @property $orderBasketable
 * @property $order
 */
class OrderBasket extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_basketable_type', "order_basketable_id" ,
        "cookie" , "submitted" ,
        "name" , "description" , "price" , "off" ,
        "order_id" ,
    ];

    protected $casts = [
        "description" => "array" ,
        "submitted" => "boolean" ,
    ];

    ///==============================================
    /// relations
    /// ==============================================

    public function orderBasketable(){
        return $this->morphTo(__FUNCTION__ , "order_basketable_type" , "order_basketable_id");
    }

    /// belongsTo
    public function order(){
        return $this->belongsTo(Order::class);
    }

    //// hasMany


}
