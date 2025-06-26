<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Conversion extends Model
{
    protected $primaryKey = 'conversion_id';

    protected $fillable = [
        'raw_material_batch_id',
        'input_product_batch_id',
        'output_product_batch_id',
        'batch_type',
        'quantity_used',
    ];

    public function rawMaterialBatch()
    {
        return $this->belongsTo(RawMaterialBatch::class, 'raw_material_batch_id');
    }

    public function inputProductBatch()
    {
        return $this->belongsTo(ProductBatch::class, 'input_product_batch_id', 'product_batch_id');
    }

    public function outputProductBatch()
    {
        return $this->belongsTo(ProductBatch::class, 'output_product_batch_id', 'product_batch_id');
    }
}
