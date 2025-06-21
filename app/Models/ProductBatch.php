<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductBatch extends Model
{    protected $fillable = [
        'user_id',
        'product_id',
        'quantity_in',
        'quantity_out',
        'quantity_remaining',
        'real_cost',
        'notes',
        'status',
        'reproduction_count',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
