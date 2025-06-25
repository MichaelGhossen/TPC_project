<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductionSetting extends Model
{
    use HasFactory;

    protected $primaryKey = 'production_settings_id';

    protected $fillable = [
        'user_id',
        'total_production',
        'type',
        'profit_ratio',
        'month',
        'year',
        'notes',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

