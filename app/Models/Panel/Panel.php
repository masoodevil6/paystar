<?php

namespace App\Models\Panel;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property $id
 * @property $icon
 * @property $name
 * @property $link
 * @property $panel_group_id
 * @property $created_at
 * @property $updated_at
 * --------
 * @property $panelGroup
 * @property $admins
 */
class Panel extends Model
{
    use HasFactory;

    protected $fillable = ["icon" ,"name" ,"link" ,"panel_group_id"];

    ///==============================================
    /// Relations
    /// ==============================================

    //// belongsTo
    public function panelGroup(){
        return $this->belongsTo(PanelGroup::class);
    }


    //// belongsToMany
    public function admins(){
        return $this->belongsToMany(Admin::class);
    }

}
