<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use HasFactory;
class RawMaterialBatch extends Model
{

    protected $primaryKey = 'raw_material_batch_id';

    protected $fillable = [
        'user_id',
        'raw_material_id',
        'quantity_in',
        'quantity_out',
        'quantity_remaining',
        'real_cost',
        'payment_method',
        'supplier',
        'notes',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function rawMaterial()
    {
        return $this->belongsTo(RawMaterial::class, 'raw_material_id');
    }
}
