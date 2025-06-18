<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProfitLossReport extends Model
{
    protected $primaryKey = 'report_id';

    protected $fillable = [
        'product_sale_id',
        'damaged_material_id',
        'type',
        'net_profit_loss',
        'notes',
    ];

    public function productSale()
    {
        return $this->belongsTo(ProductSale::class, 'product_sale_id');
    }

    public function damagedMaterial()
    {
        return $this->belongsTo(DamagedMaterial::class, 'damaged_material_id');
    }
}
