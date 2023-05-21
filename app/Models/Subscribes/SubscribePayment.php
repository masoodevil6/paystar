<?php

namespace App\Models\Subscribes;

use App\Models\Banks\Bank;
use App\Models\Users\User;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

/**
 * @property $user_id
 * @property $subscribe_id
 * @property $bank_name
 * @property $res_num
 * @property $ref_num
 * @property $amount
 * @property $phone
 * @property $email
 * @property $status
 * @property $admin_add
 * @property $time_set
 * @property $duration
 * @property $created_at
 * @property $updated_at
 * --------
 * @property $time_start
 * @property $time_end
 * --------
 * @property $subscribe
 * @property $user
 */
class SubscribePayment extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'subscribe_id',
        'bank_name',
        'res_num',
        "ref_num",
        "amount",
        "phone",
        "email",
        "status",
        "admin_add",
        "time_set" ,
        "duration"
    ];

    private static $status= [
        [
            "id" => 0 ,
            "title" => "پرداخت نشده"
        ],
        [
            "id" => 1 ,
            "title" => "پرداخت شده"
        ]
    ];

    protected $appends=[
        "time_start" , "time_end"
    ];

    ///==============================================
    /// functions
    /// ==============================================

    public static function status() :Attribute{

        return Attribute::make(
            get: fn($attr , $value) => self::getStatus($value["status"])
        );
    }

    private static function getStatus($status){
        $resultExp="";
        foreach (self::$status AS $itemStatus){
            if ($status == $itemStatus["id"]){
                $resultExp = $itemStatus;
                break;
            }
        }
        return $resultExp;
    }



    public static function timeStart() :Attribute{

        return Attribute::make(
            get: fn($attr , $value) => ((isset($value["time_set"])) ? $value["time_set"] : "")
        );
    }

    public static function timeEnd() :Attribute{
        return Attribute::make(
            //get: fn($attr , $value) => ((isset($value["time_set"]) && isset($value["duration"])) ? $value["time_set"] : "")
            get: fn($attr , $value) => ((isset($value["time_set"]) && isset($value["duration"])) ? Carbon::parse( $value["time_set"])->addMonth($value["duration"])->toDateTimeString() : "")
        );
    }




    ///==============================================
    /// relations
    /// ==============================================

    /// belongsTo
    public function subscribe(){
        return $this->belongsTo(Subscribe::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }


    //// has many

}
