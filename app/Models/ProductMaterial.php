<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductMaterial extends Model
{
    protected $primaryKey = 'product_material_id';

    protected $fillable = [
        'product_id',
        'raw_material_id',
        'quantity_required_per_unit',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function rawMaterial()
    {
        return $this->belongsTo(RawMaterial::class);
    }
}
