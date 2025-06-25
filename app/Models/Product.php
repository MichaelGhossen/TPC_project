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
        'category',
        'weight_per_unit',
        'minimum_stock_alert',
    ];

    public function product_materials()
    {
        return $this->hasMany(ProductMaterial::class, 'product_id', 'product_id');
    }
}
