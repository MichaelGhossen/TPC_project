<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use HasFactory;
class Expense extends Model
{

    protected $primaryKey = 'expense_id';

    protected $fillable = [
        'user_id',
        'employee_salaries',
        'transportation',
        'taxes',
        'utility_bills',
        'phone_bills',
        'maintenance',
        'administrative_costs',
        'other_costs',
        'type',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
