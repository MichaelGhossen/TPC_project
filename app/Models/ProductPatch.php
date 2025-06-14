<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductPatch extends Model
{
    protected $primaryKey = 'patch_id';

    protected $fillable = [
        'user_id',
        'product_id',
        'quantity_in',
        'quantity_out',
        'quantity_remaining',
        'real_cost',
        'category',
        'notes',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
