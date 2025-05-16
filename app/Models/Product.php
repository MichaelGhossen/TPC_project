<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name_id',
        'bom',
        'category',
        'quantity',
        'price',
        'real_cost',
        'estimated_cost',
        'production_date',
        'user_id',
    ];
    protected $casts = [
        'bom' => 'array',                  // لتتعامل مع JSON تلقائياً
        'production_date' => 'date',      // لتتعامل مع التاريخ بشكل تلقائي
    ];
    public function name()
    {
        return $this->belongsTo(Name::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
