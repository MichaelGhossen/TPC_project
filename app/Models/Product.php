<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use HasFactory;

class Product extends Model
{

    protected $primaryKey = 'product_id';

    protected $fillable = [
        'name',
        'description',
        'price',
        'weight_per_unit',
        'minimum_stock_alert',
    ];

}
