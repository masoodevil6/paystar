<?php

namespace App\Models\Users;

use App\Models\Banks\BankPayment;
use App\Models\Banks\BankPaymentRefund;
use App\Models\Banks\BankPaymentUnVerify;
use App\Models\Offs\CodeOff;
use App\Models\Orders\Order;
use App\Models\Panel\Admin;
use App\Models\Panel\AdminUser;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

/**
 * @property int $id
 * @property string $name
 * @property string $family
 * @property string $cart_number
 * @property string $mobile
 * @property string $email
 * @property string $password
 * @property $profile_photo_path
 * @property $activation
 * @property $activation_time
 * @property $status
 * @property $created_at
 * @property $updated_at
 * --------
 * @property string $full_name
 * --------
 * @property Admin $admins
 * @property Otp $otps
 * @property AdminUser $admin
 * @property BankPayment $bankPayments
 * @property Order $orders
 * @property CodeOff $codeOffs
 * @property BankPaymentRefund $bankPaymentRefund
 * @property BankPaymentUnVerify $bankPaymentUnVerifies
 */
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;


    protected $fillable = [
        'name',
        'family',
        'cart_number',
        'mobile',
        'email',
        'password' ,
        'profile_photo_path' ,
        'activation' ,
        'activation_time' ,
        'status' ,
    ];


    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $appends = ["full_name"];

    ///==============================================
    /// functions
    /// ==============================================

    public static function fullName() :Attribute{

        return Attribute::make(
            get: fn($attr , $value) => ($value["name"] !="" || $value["family"] != "" ) ? $value["name"]." ".$value["family"] : "کاربر"
        );
    }


    ///==============================================
    /// Relations
    /// ==============================================

    //// belongsTo
    public function admins(){
        return $this->belongsToMany(Admin::class)->withPivot("status" , "password");
    }


    //// hasMany

    public function otps(){
        return $this->hasMany(Otp::class);
    }

    public function admin(){
        return $this->hasOne(AdminUser::class);
    }

    public function bankPayments(){
        return $this->hasMany(BankPayment::class);
    }

    public function orders(){
        return $this->hasMany(Order::class);
    }

    public function codeOffs(){
        return $this->hasMany(CodeOff::class);
    }

    public function bankPaymentRefunds(){
        return $this->hasMany(BankPaymentRefund::class);
    }

    public function bankPaymentUnVerifies(){
        return $this->hasMany(BankPaymentUnVerify::class);
    }
}
