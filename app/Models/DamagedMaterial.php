<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DamagedMaterial extends BaseModel
{
    use HasFactory;

    protected $primaryKey = 'damaged_material_id';

    protected $fillable = [
        'product_batch_id',
        'raw_material_batch_id',
        'user_id',
        'notes',
        'quantity',
        'material_type',
        'lost_cost'
    ];

    protected $casts = [
        'material_type' => 'string', // Explicit casting for enum
    ];

    /**
     * Relationship to the product batch (for semi-finished/finished products)
     */
    public function productBatch()
    {
        return $this->belongsTo(ProductBatch::class, 'product_batch_id','product_batch_id');
    }

    /**
     * Relationship to the raw material batch
     */
    public function rawMaterialBatch()
    {
        return $this->belongsTo(RawMaterialBatch::class, 'raw_material_batch_id','raw_material_batch_id');
    }

    /**
     * Relationship to the user who reported the damage
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Dynamic accessor for the damaged material
     */
    public function material()
    {
        return match ($this->material_type) {
            'raw' => $this->rawMaterialBatch,
            'semi' => $this->productBatch,
            'product' => $this->productBatch,
            default => null,
        };
    }
}
