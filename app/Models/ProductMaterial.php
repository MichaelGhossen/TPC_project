<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProductMaterial extends Model
{
    use HasFactory;

    protected $primaryKey = 'product_material_id';

    protected $fillable = [
        'product_id',
        'semi_product_id',
        'raw_material_id',
        'component_type',
        'quantity_required_per_unit',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function semiProduct()
    {
        return $this->belongsTo(Product::class, 'semi_product_id','product_id');
    }

    public function rawMaterial()
    {
        return $this->belongsTo(RawMaterial::class, 'raw_material_id');
    }

    public function scopeRawMaterials($query)
    {
        return $query->where('component_type', 'raw_material');
    }

    public function scopeSemiProducts($query)
    {
        return $query->where('component_type', 'product');
    }
}
