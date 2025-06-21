<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DamagedMaterial extends Model
{
    protected $primaryKey = 'damaged_material_id';

    protected $fillable = [
        'semi_finished_batch_id',
        'product_batch_id',
        'raw_material_batch_id',
        'user_id',
        'notes',
        'quantity',
        'material_type',
        'lost_cost',
    ];

    public function semiFinishedBatch()
    {
        return $this->belongsTo(SemiFinishedBatch::class, 'semi_finished_batch_id');
    }

    public function productBatch()
    {
        return $this->belongsTo(ProductBatch::class, 'product_batch_id');
    }

    public function rawMaterialBatch()
    {
        return $this->belongsTo(RawMaterialBatch::class, 'raw_material_batch_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
