<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends BaseModel
{
    use HasFactory;

    protected $primaryKey = 'product_id';

    protected $fillable = [
        'name',
        'description',
        'price',
        'category',
        'weight_per_unit',
        'minimum_stock_alert'
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'weight_per_unit' => 'decimal:2',
        'minimum_stock_alert' => 'decimal:2',
        'category' => 'string',
    ];

    /**
     * Relationship to product materials (BOM components)
     */
    public function productMaterials()
    {
        return $this->hasMany(ProductMaterial::class, 'product_id','product_id');
    }

    /**
     * Relationship to production batches
     */
    public function batches()
    {
        return $this->hasMany(ProductBatch::class, 'product_id'); // Removed redundant third param
    }

    /**
     * Scope for different product categories
     */
    public function scopeDirectRaw($query)
    {
        return $query->where('category', 'direct_raw');
    }

    public function scopeSemiRaw($query)
    {
        return $query->where('category', 'semi_raw');
    }

    public function scopeSemiToFinished($query)
    {
        return $query->where('category', 'semi_to_finished');
    }

    /**
     * Accessor for product type
     */
    public function getTypeAttribute()
    {
        return match($this->category) {
            'direct_raw' => 'Finished from raw materials',
            'semi_raw' => 'Semi-finished product',
            'semi_to_finished' => 'Finished from semi-finished',
            default => 'Unknown',
        };
    }
}
