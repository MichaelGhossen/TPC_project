<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductSale extends Model
{
    protected $primaryKey = 'product_sale_id';

    protected $fillable = [
        'product_id',
        'semi_finished_batch_id',
        'product_batch_id',
        'user_id',
        'quantity_sold',
        'unit_price',
        'customer',
        'net_profit',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function semiFinishedBatch()
    {
        return $this->belongsTo(SemiFinishedBatch::class, 'semi_finished_batch_id');
    }

    public function productBatch()
    {
        return $this->belongsTo(ProductBatch::class, 'product_batch_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
