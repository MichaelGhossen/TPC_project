<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class RawMaterial extends Model
    {
        use HasFactory;

        protected $fillable = [
            'status',
            'quantity',
            'added_date',
            'price',
            'real_cost',
            'estimated_cost',
            'user_id',
            'name_id',
        ];

        public function user()
        {
            return $this->belongsTo(User::class);
        }

        public function name()
        {
            return $this->belongsTo(Name::class);
        }
}
