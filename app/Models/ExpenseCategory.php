<?php

namespace App\Models;

use Faker\Provider\Base;
use Illuminate\Database\Eloquent\Model;

class ExpenseCategory extends BaseModel
{
    protected $primaryKey = 'expense_category_id';

    protected $fillable = [
        'name',
        'description',
    ];

    public function expenses()
    {
        return $this->hasMany(Expense::class, 'expense_category_id');
    }
}
