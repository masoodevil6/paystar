<?php

namespace App\Models\Users;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * @property $id
 * @property $token
 * @property $otp_code
 * @property $input_login
 * @property $type
 * @property $used
 * @property $status
 * @property $user_id
 * @property $created_at
 * @property $updated_at
 * --------
 * @property $user
 */
class Otp extends Authenticatable
{
    use HasFactory;
    use HasApiTokens;

    protected $table="OTPs";


    protected $fillable = [
        'token', "otp_code" , "input_login" , "type" , "used" , "status" , "user_id",
    ];

    public $types = [
        [
            "type" => 0 ,
            "title" => "phone" ,
        ],
        [
            "type" => 1 ,
            "title" => "email" ,
        ]
    ];


    //// =======================================
    /// Relations
    /// ========================================
    public function user(){
        return $this->belongsTo(User::class);
    }

}
