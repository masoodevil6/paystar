<?php

namespace App\Models\Offs;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property $min_price
 * @property $off_price
 * @property $period
 * @property $status
 * @property $created_at
 * @property $updated_at
 */
class CodeOffStatus extends Model
{
    use HasFactory;

    protected $fillable = [
        "min_price" , "off_price", "period", "status",
    ];
}
