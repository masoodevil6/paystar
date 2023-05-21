<?php

namespace App\Models\Panel;

use App\Models\Users\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property $id
 * @property $title
 * @property $status
 * @property $main
 * @property $created_at
 * @property $updated_at
 * --------
 * @property $panels
 * @property $users
 */
class Admin extends Model
{
    use HasFactory;
    use SoftDeletes;

    private static $panelPass = 75297530;

    protected $fillable = ["title" , "status" , "main"];


    ///==============================================
    /// functions
    /// ==============================================

    public static function getPanelPass(){
        return self::$panelPass;
    }



    ///==============================================
    /// Relations
    /// ==============================================

    //// belongsTo
    public function panels(){
        return $this->belongsToMany(Panel::class)->orderBy("id");
    }

    public function users(){
        return $this->belongsToMany(User::class)->withPivot("status");
    }


    //// hasMany
}
