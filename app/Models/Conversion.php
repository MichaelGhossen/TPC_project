<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Conversion extends Model
{
    protected $primaryKey = 'conversion_id';

    protected $fillable = [
        'semi_finished_batch_id',
        'product_batch_id',
        'quantity_used',
        'additional_costs',
    ];

    public function semiFinishedBatch()
    {
        return $this->belongsTo(SemiFinishedBatch::class, 'semi_finished_batch_id');
    }

    public function productBatch()
    {
        return $this->belongsTo(ProductPatch::class, 'product_batch_id');
    }
}
