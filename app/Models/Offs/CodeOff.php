<?php

namespace App\Models\Offs;

use App\Models\Users\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property $id
 * @property $code
 * @property $off_price
 * @property $period
 * @property $min_price
 * @property $image
 * @property $is_public
 * @property $used
 * @property $status
 * @property $user_id
 * @property $created_at
 * @property $updated_at
 * --------
 * @property $user
 */
class CodeOff extends Model
{
    use HasFactory;

    protected $fillable = [
        "code" , "off_price", "period",
        "min_price", "image" ,
        "is_public",  "used" , "status" ,
        "user_id" ,
    ];


    ///==============================================
    /// Relations
    /// ==============================================

    //// belongsTo
    public function user(){
        return $this->belongsTo(User::class);
    }

    //// hasMany

}
