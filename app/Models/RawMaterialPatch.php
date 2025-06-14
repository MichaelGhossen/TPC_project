<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use HasFactory;
class RawMaterialPatch extends Model
{

    protected $primaryKey = 'patch_id';

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
        return $this->belongsTo(User::class);
    }

    public function rawMaterial()
    {
        return $this->belongsTo(RawMaterial::class);
    }
}
