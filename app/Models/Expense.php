<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use HasFactory;
class Expense extends Model
{
    protected $primaryKey = 'expense_id';

    protected $fillable = [
        'user_id',
        'expense_category_id',
        'type',
        'amount',
        'notes',
    ];

    public function category()
    {
        return $this->belongsTo(ExpenseCategory::class, 'expense_category_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
