<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductSale extends Model
{
    protected $primaryKey = 'product_sales_id';

    protected $fillable = [
        'user_id',
        'product_id',
        'product_patch_id',
        'quantity_sold',
        'unit_price',
        'customer',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function patch()
    {
        return $this->belongsTo(ProductPatch::class, 'product_patch_id');
    }
}
