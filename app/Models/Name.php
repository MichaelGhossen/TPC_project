<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Name extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'type', // raw or product
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function rawMaterials()
    {
        return $this->hasMany(RawMaterial::class);
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
