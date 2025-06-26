<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RawMaterial extends Model
{
    use HasFactory; // Fixed missing import

    protected $primaryKey = 'raw_material_id';

    protected $fillable = [
        'name',
        'description',
        'price',
        'status',
        'minimum_stock_alert',
    ];

    /**
     * Relationship to product materials where this is a component
     */
    public function productMaterials()
    {
        return $this->hasMany(ProductMaterial::class, 'raw_material_id');
    }
}
