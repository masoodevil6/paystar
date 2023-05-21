<?php

namespace App\Models\Panel;

use App\Models\Users\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * @property $id
 * @property $status
 * @property $password
 * @property $created_at
 * @property $updated_at
 * --------
 * @property $admin
 * @property $user
 */
class AdminUser extends Authenticatable
{
    use HasFactory;
    protected $table = "admin_user";
    protected $guarded = "admin";
    protected $fillable = ["status" , "password" , "user_id" , "admin_id" , "main"];


    public function scopeFindUser($query , $userId){
        return $query->where("user_id" , $userId) ;
    }

    public function scopeFindAdmin($query , $adminId){
        return $query->where("admin_id" , $adminId) ;
    }

    ///==============================================
    /// Relations
    /// ==============================================

    //// belongsTo
    public function admin(){
        return $this->belongsTo(Admin::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }


}
