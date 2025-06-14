<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use HasFactory;

class RawMaterial extends Model
{

    protected $primaryKey = 'raw_material_id';

    protected $fillable = [
        'name',
        'description',
        'price',
        'status',
        'minimum_stock_alert',
    ];
}
