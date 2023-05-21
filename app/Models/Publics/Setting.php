<?php

namespace App\Models\Publics;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property $id
 * @property $titleEn
 * @property $titleFa
 * @property $value
 * @property $created_at
 * @property $updated_at
 */
class Setting extends Model
{
    use HasFactory;

    protected $fillable = [
        "titleEn" , "titleFa" , "value"
    ];

}
