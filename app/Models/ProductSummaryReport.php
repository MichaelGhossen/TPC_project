<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductSummaryReport extends Model
{
    protected $primaryKey = 'report_id';

    protected $fillable = [
        'product_id',
        'quantity_produced',
        'quantity_sold',
        'total_costs',
        'total_estimated_expences',
        'total_actual_expences',
        'total_income',
        'net_profit',
        'type',
        'notes',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
